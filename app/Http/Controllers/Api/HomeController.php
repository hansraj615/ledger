<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ledger\LoginRequest;
// use App\MyHealthcare\Repositories\DoctorLogin\DoctorLoginInterface;
use App\Ledger\Auth\JwtAuthentication;
use App\Ledger\Repositories\LedgerLogin\LedgerLoginInterface;
// use App\Http\Requests\Api\Doctor\Doctors\V1\LoginOtpRequest;
// use App\MyHealthcare\Transformers\Api\Doctor\HospitalsTransformer;
// use App\MyHealthcare\Repositories\MasterDoctorIndex\MasterDoctorIndexInterface;
// use App\MyHealthcare\Repositories\Doctor\DoctorInterface;
// use App\MyHealthcare\Repositories\DoctorSchedule\DoctorScheduleInterface;
// use App\MyHealthcare\Repositories\BlockDoctorSlot\BlockDoctorSlotInterface;
// use App\Http\Requests\Api\Doctor\Doctors\V1\LateAlertRequest;
// use App\Http\Requests\Api\Doctor\Doctors\V1\LateAlertStatusRequest;
// use App\MyHealthcare\Helpers\NotificationQueue;
use App\User;
use Exception;

class HomeController extends BaseController {

    public $jwtauth;
    public $ledgerlogin;

    public function __construct( JwtAuthentication $jwtauth,LedgerLoginInterface $ledgerlogin) {
        $this->jwtauth = $jwtauth;
        $this->ledgerlogin = $ledgerlogin;
    }

    public function index(LoginRequest $request) {
        try {
            $data = array();
            $data['email'] = !empty($request->has('email')) ? $request->get('email') : null;
            $data['pwd'] = !empty($request->has('password')) ? $request->get('password') : null;
            $response = $this->ledgerlogin->getData($request);
            $final_response = [];
            if (!empty($response['id'])) {
                $jwt_token = $this->jwtauth->generateToken($response['id']);
                $headers = [
                    'Authorization' => $jwt_token,
                ];
                $final_response['message'] = "Ledger logged in";
                $final_response['ledger'] = $response;
                $this->ledgerlogin->isLoggedIn($response['id'], true);
                return response()->json($final_response, 200, $headers);
            } else {
                return response()->json($response, 400);
            }
        } catch (Exception $ex) {
            logger()->error($ex->getMessage());
            abort(400, trans('errors.LEDGER_101'));
        }
    }

    // public function configuration() {

    // }

    // public function logout(Request $request) {
    //     $response = [];
    //     $doctorId = config('api.current_user.doctor_id');
    //     $this->doctor->isLoggedOut($doctorId, true);
    //     $response['message'] = trans('success.DOCTORS_113');
    //     return response()->json($response, 200);
    // }

    public function changePassword(Request $request) {
        try {
            // dd($request->user_id);
            $userId = !empty($request->user_id)?$request->user_id:config('api.current_user.user_id');
            $response = $this->ledgerlogin->checkPassword($request, $userId);
            // dd($response);
            return response()->json($response, 200);
        } catch (Exception $ex) {
            logger()->error($ex->getMessage());
            abort(400, trans('errors.LEDGER_101'));
        }
    }

    // public function loginWithOtp(LoginOtpRequest $request) {
    //     try {
    //         $masterDoctorIndecies = $this->masterDoctorIndexInterface->create($request);

    //         $setOtp = $this->masterDoctorIndexInterface->setOtp($request);
    //         $doctorObject = $this->doctorInterface->getUserDateUsingMobile($request->input('uid'));
    //         $crypticNumber = 'XXXXXXX' . substr($request->input('uid'), 7);
    //         return response()->json([
    //                     'message' => trans('success.PATIENT_114'),
    //                     'mobile_number' => $crypticNumber,
    //                     'doctor_id' => $doctorObject->id
    //                         ], 200);
    //     } catch (Exception $ex) {
    //         logger()->error($ex->getMessage());
    //         abort(400, trans('errors.DOCTOR_101'));
    //     }
    // }

    // public function verifyOtp(Request $request) {
    //     try {
    //         $masterDoctorIndecies = $this->masterDoctorIndexInterface->validateOtp($request);
    //         $response = $this->doctorInterface->getUserDateUsingMobile($request->input('uid'));
    //         $final_response = [];
    //         if (!empty($response['id'])) {

    //             $userDevice = \App\Models\UserDevice::where("notifiable_id", $response['id'])->first();
    //             if (!empty($userDevice)) {
    //                 $userDevice->device_type = !empty(config('constants.DEVICE_TYPE')[$request->segment(3)]) ? config('constants.DEVICE_TYPE')[$request->segment(3)] : 0;
    //                 $userDevice->save();
    //             }
    //             $jwt_token = $this->jwtauth->generateToken($response['id']);
    //             $headers = [
    //                 'Authorization' => $jwt_token,
    //             ];
    //             $response = $this->doctor->doctorProfileOtp($response['id']);
    //             $final_response['message'] = "Doctor logged in";
    //             $final_response['doctor'] = $response;
    //             $this->doctor->isLoggedIn($response[0]['id'], true);
    //             return response()->json($final_response, 200, $headers);
    //         } else {
    //             return response()->json($response, 400);
    //         }
    //     } catch (Exception $ex) {
    //         logger()->error($ex->getMessage());
    //         abort(400, trans('errors.DOCTOR_101'));
    //     }
    // }

    // public function lateAlert(LateAlertRequest $request) {
    //     try {
    //         //$doctorId = config('api.current_user.doctor_id');
    //         $doctorId = !empty($request->doctor_id)?$request->doctor_id:config('api.current_user.doctor_id');
    //         $currentDate = date("Y-m-d",strtotime("+330 minutes"));
    //         //$currentDate = "2018-08-08";
    //         $dateFor = $currentDate;
    //         $StartDate = $currentDate;
    //         $EndDate = $currentDate;
    //         $getDoctorTime = $this->doctorScheduleInterface->getDoctorTime($request, $doctorId);
    //         $block_time = $request->late_time;
    //         $currentTime = date("H:i:s", strtotime("+330 minutes"));
    //         if ($getDoctorTime[0]->start_time <= $currentTime) {
    //             return response()->json([
    //                         'status' => false,
    //                         'message' => "Practice time already started, you cannot submit late alert now.",
    //                             ], 200);
    //         }

    //         if (!empty($getDoctorTime)) {
    //             $slot_duration = $getDoctorTime[0]->slot_duration;
    //             $SlotID = $getDoctorTime[0]->id;
    //             if ($block_time > $slot_duration) {
    //                 $diffSlotTime = ($block_time % $slot_duration);
    //                 if ($diffSlotTime <= ceil($slot_duration / 2)) {
    //                     $block_time -= $diffSlotTime;
    //                 } else {
    //                     $block_time += $diffSlotTime;
    //                 }
    //                 $modifiedBlockTime = $block_time;
    //                 $start_time = $getDoctorTime[0]->start_time;
    //                 $end_time = date("H:i:s", strtotime("+ $modifiedBlockTime minutes", strtotime($start_time)));
    //                 $blockSlotCount = (strtotime($end_time) - strtotime($start_time)) / (60 * $slot_duration);
    //                 $blockSlots = array();
    //                 $temp = $start_time;
    //                 $i = 0;
    //                 while ($i <= $blockSlotCount) {
    //                     $blockSlots[] = $temp;
    //                     $temp = date("H:i:s", strtotime("+ $slot_duration minutes", strtotime($temp)));
    //                     $i++;
    //                 }
    //             } else {
    //                 $temp = date("H:i:s", strtotime($getDoctorTime[0]->start_time));
    //                 $blockSlots[] = $temp;
    //             }
    //             //$diffSlotTime = ($block_time % $slot_duration);

    //             $blockTimings = "'" . implode("','", $blockSlots) . "'";
    //             $getBlockSlot = $this->doctorScheduleInterface->getBlockSlot($SlotID, $blockTimings);
    //             $block_params = [];
    //             $i = 0;
    //             if (!empty($getBlockSlot)) {
    //                 foreach ($getBlockSlot as $slot) {
    //                     $block_params['data'][$i]['slots'][] = $slot->id;
    //                 }
    //                 $block_params['data'][$i]['date'] = $dateFor;
    //                 $block_params['data'][$i]['reason'] = $request->comment;
    //             }
    //             $doctor = $this->doctor->findDoctor($doctorId);
    //             $hospital = Hospital::find($request->hospital_id);
    //             if (!empty($block_params)) {
    //                 //echo "doctor_session_slot_id in (".implode(",",$block_params['data'][0]['slots']).")";
    //                 $bookings = \App\Models\Booking::WhereRaw("doctor_session_slot_id in (" . implode(",", $block_params['data'][0]['slots']) . ")")->where("booking_date", $block_params['data'][0]['date'])->get()->pluck('booking_code')->toArray();
    //                 if (count($bookings) == 0 || !empty($request->confirm)) {
    //                     $this->blockDoctorSlotInterface->block($doctorId, $block_params);
    //                     if (!empty($hospital->late_alert_email)) {
    //                         $title = str_replace(['##DOCT_NM##', '##Hospital_Name##', '##MINUTES##', '##APPOINTMENTS_COUNT##','##DT_TIME##'], [$doctor->full_name, $hospital->name, $block_time, count($bookings),$dateFor], trans('emailer.DOCTOR_101'));
    //                         $subject = "Late Alert - Immediate action required";
    //                         $mailData = [];
    //                         $mailData['patient_email'] = $hospital->late_alert_email;
    //                         $mailData['patient_first_name'] = "Admin";
    //                         $mailData['title'] = $title;
    //                         $mailData['doctor'] = $doctor->full_name;
    //                         $mailData['hospital'] = $hospital->name;
    //                         $mailData['late_running_time'] = $request->late_time;
    //                         $mailData['date'] = $dateFor;
    //                         $mailData['booking_count'] = count($bookings);
    //                         $mailData['bookings'] = $bookings;


    //                         //Mail::to($booking->patient->email, $booking->patient->full_name)->queue((new \App\Mail\ConfirmAppointment($mailData,$subject))->onQueue(config('api.patients_api.default_queue')));

    //                         $to_email = $hospital->late_alert_email;
    //                         $to_name = "Admin";
    //                         $mailableClassFullPath = '\App\Mail\LateAlertAppointment';
    //                         $worker_name = config('constants.QUEUE_WORKERS.app_apis_medium');

    //                         NotificationQueue::sendEmailNotification($to_email, $to_name, $mailableClassFullPath, $subject, $mailData, $worker_name);
    //                     }
    //                     return response()->json([
    //                                 'status' => true,
    //                                 'message' => trans('success.DOCTORS_118'),
    //                                     ], 200);
    //                 } else {
    //                     return response()->json([
    //                                 'has_appointment' => true,
    //                                 'message' => "This action will affect " . count($bookings) . " appointments of the day. Would you still like to continue?",
    //                                     ], 200);
    //                 }
    //             } else {
    //                 return response()->json([
    //                             'status' => false,
    //                             'message' => trans('errors.DOCTORS_126'),
    //                                 ], 200);
    //             }
    //         } else {
    //             return response()->json([
    //                         'status' => true,
    //                         'message' => trans('errors.DOCTORS_126'),
    //                             ], 400);
    //         }
    //     } catch (Exception $ex) {
    //         logger()->error($ex->getMessage());
    //         abort(400, trans('errors.DOCTOR_101'));
    //     }
    // }

    // public function blockStatus(LateAlertStatusRequest $request) {
    //     try {
    //         //$doctorId = config('api.current_user.doctor_id');
    //         $doctorId = !empty($request->doctor_id)?$request->doctor_id:config('api.current_user.doctor_id');
    //         $dateFor = date("Y-m-d",strtotime("+330 minutes"));
    //         $dcotorObject=$this->doctor->findDoctor($doctorId);
    //         if(!$dcotorObject->is_active_doctor){
    //             return response()->json([
    //                         'status' => true,
    //                         'message' => "Sorry!! you are not an active care provider",
    //                             ], 200);
    //         }
    //         $StartDate = date("Y-m-d",strtotime("+330 minutes"));
    //         $EndDate = date("Y-m-d",strtotime("+330 minutes"));
    //         $getDoctorTime = $this->doctorScheduleInterface->getDoctorTime($request, $doctorId);
    //         if (!empty($getDoctorTime)) {
    //             $SlotsIDs = $this->doctorScheduleInterface->getSlotsIds($getDoctorTime[0]->id);
    //         } else {
    //             return response()->json([
    //                         'status' => true,
    //                         'message' => trans('errors.DOCTORS_126'),
    //                             ], 200);
    //         }
    //         $slot_array = array();
    //         $slot_string = null;
    //         if (!empty($SlotsIDs)) {
    //             foreach ($SlotsIDs as $slot) {
    //                 $slot_array[] = $slot->id;
    //             }
    //         }
    //         $slot_string = implode(",", $slot_array);
    //         $getDoctorBlockCount = count($this->doctorScheduleInterface->identifyBlockForDay($dateFor, $doctorId, $slot_string));
    //         if ($getDoctorBlockCount > 0) {
    //             return response()->json([
    //                         'status' => true,
    //                         'message' => trans('success.DOCTORS_120'),
    //                             ], 200);
    //         } else {

    //             return response()->json([
    //                         'status' => false,
    //                         'message' => "",
    //                             ], 200);
    //         }
    //     } catch (Exception $ex) {
    //         logger()->error($ex->getMessage());
    //         abort(400, trans('errors.DOCTOR_101'));
    //     }
    // }

}

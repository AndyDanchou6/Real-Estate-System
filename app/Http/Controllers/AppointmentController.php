<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Property;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'location' => 'nullable|string|max:255',
            'confirmation_status' => 'nullable|boolean',
            'cancellation_reason' => 'nullable|string',
            'schedule' => 'nullable|date_format:Y-m-d',
        ]);

        $property = Property::findOrFail($validatedData['property_id']);
        $agentId = $property->agent_id;
        $clientId = Auth::user()->id;

        $existingAppointment = Appointment::where('agent_id', $agentId)
            ->where('client_id', $clientId)
            ->where('property_id', $validatedData['property_id'])
            ->exists();

        if ($existingAppointment != null) {
            return response()->json([
                'status' => 200,
                'message' => 'You have already booked an appointment on this',
                'data' => $existingAppointment
            ]);
        }

        $validatedData['client_id'] = $clientId;
        $validatedData['agent_id'] = $agentId;

        try {
            $appointment = Appointment::create($validatedData);

            if ($appointment) {
                return response()->json([
                    'status' => 201,
                    'message' => 'Created appointment successfully',
                    'data' => $appointment
                ]);
            }

            return response()->json([
                'status' => 500,
                'message' => 'Appointment creation failed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ]);
        }
    }

    public function clientAppointments()
    {
        $clientId = Auth::id();

        $appointments = Appointment::where('client_id', $clientId)
            ->with('agent')
            ->with('property')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Appointments found',
            'data' => $appointments,
        ]);
    }

    public function agentAppointments()
    {
        $agentId = Auth::id();

        $appointments = Appointment::where('agent_id', $agentId)
            ->with('client')
            ->with('property')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Appointments found',
            'data' => $appointments,
        ]);
    }

    public function delete($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment && $appointment->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Appointment deleted successfully'
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Appointment was not deleted'
        ]);
    }

    public function scheduleAppointment(Request $request, $id)
    {
        $validator = $request->validate([
            'location' => 'required|string|max:255',
            'schedule' => 'required|date'
        ]);

        try {
            $appointment = Appointment::findOrFail($id);

            $appointment->location = $request->input('location');
            $appointment->schedule = $request->input('schedule');
            $appointment->confirmation_status = true;

            $saved = $appointment->save();

            if (!$saved) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Appointment not updated'
                ], 500);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Appointment scheduled successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

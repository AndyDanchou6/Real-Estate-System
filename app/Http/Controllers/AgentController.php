<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class AgentController extends Controller
{
    public function all($filter)
    {
        $agentId = Auth::user()->id;

        if ($filter == 'house') {

            $all = Property::where('agent_id', $agentId)
                ->where('type', 'house')
                ->get();
        } elseif ($filter == 'land') {

            $all = Property::where('agent_id', $agentId)
                ->where('type', 'land')
                ->get();
        } elseif ($filter == 'commercial') {

            $all = Property::where('agent_id', $agentId)
                ->where('type', 'commercial')
                ->get();
        } else {

            $all = Property::where('agent_id', $agentId)
                ->get();
        }

        return response()->json($all);
    }

    public function forRent($filter)
    {
        $agentId = Auth::user()->id;

        if ($filter == 'house') {
            $forRent = Property::where('agent_id', $agentId)
                ->where('adType', 'forRent')
                ->where('type', 'house')
                ->get();
        } elseif ($filter == 'land') {
            $forRent = Property::where('agent_id', $agentId)
                ->where('adType', 'forRent')
                ->where('type', 'land')
                ->get();
        } elseif ($filter == 'commercial') {
            $forRent = Property::where('agent_id', $agentId)
                ->where('adType', 'forRent')
                ->where('type', 'commercial')
                ->get();
        } else {
            $forRent = Property::where('agent_id', $agentId)
                ->where('adType', 'forRent')
                ->get();
        }

        return response()->json($forRent);
    }

    public function forSale($filter)
    {
        $agentId = Auth::user()->id;

        if ($filter == 'house') {
            $forSale = Property::where('agent_id', $agentId)
                ->where('adType', 'forSale')
                ->where('type', 'house')
                ->get();
        } elseif ($filter == 'land') {
            $forSale = Property::where('agent_id', $agentId)
                ->where('adType', 'forSale')
                ->where('type', 'land')
                ->get();
        } elseif ($filter == 'commercial') {
            $forSale = Property::where('agent_id', $agentId)
                ->where('adType', 'forSale')
                ->where('type', 'commercial')
                ->get();
        } else {
            $forSale = Property::where('agent_id', $agentId)
                ->where('adType', 'forSale')
                ->get();
        }

        return response()->json($forSale);
    }

    public function search($data)
    {
        $agentId = Auth::user()->id;

        $properties = Property::where('agent_id', $agentId)
            ->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data . '%')
                    ->orWhere('location', 'like', '%' . $data . '%')
                    ->orWhere('owner', 'like', '%' . $data . '%');
            })
            ->get();

        return response()->json($properties);
    }

    public function searchForRent($data)
    {
        $agentId = Auth::user()->id;

        $forRent = Property::where('agent_id', $agentId)
            ->where('adType', 'forRent')
            ->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data . '%')
                    ->orWhere('location', 'like', '%' . $data . '%')
                    ->orWhere('owner', 'like', '%' . $data . '%');
            })
            ->get();

        return response()->json($forRent);
    }

    public function searchForSale($data)
    {
        $agentId = Auth::user()->id;

        $forRent = Property::where('agent_id', $agentId)
            ->where('adType', 'forSale')
            ->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data . '%')
                    ->orWhere('location', 'like', '%' . $data . '%')
                    ->orWhere('owner', 'like', '%' . $data . '%');
            })
            ->get();

        return response()->json($forRent);
    }
}

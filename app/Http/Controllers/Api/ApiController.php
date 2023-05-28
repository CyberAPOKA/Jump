<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getServices(Request $request)
    {
        $services = ServiceOrder::with('user')
            ->when($request->vehicle_plate, function ($query, $vehicle_plate) {
                return $query->where('vehicle_plate', 'LIKE', '%' . $vehicle_plate . '%');
            })
            ->when($request->entry_date_time, function ($query, $entry_date_time) {
                return $query->where('entry_date_time', '>=', $entry_date_time);
            })
            ->when($request->exit_date_time, function ($query, $exit_date_time) {
                return $query->where('exit_date_time', '<=', $exit_date_time);
            })
            ->when($request->user, function ($query, $user) {
                return $query->whereHas('user', function ($query) use ($user) {
                    $query->where('name', 'LIKE', '%' . $user . '%');
                });
            });

        switch ($request->orderBy) {
            case 'price_desc':
                $services = $services->orderByDesc('price');
                break;
            case 'price_asc':
                $services = $services->orderBy('price');
                break;
            case 'entry_desc':
                $services = $services->orderByDesc('entry_date_time');
                break;
            case 'entry_asc':
                $services = $services->orderBy('entry_date_time');
                break;
            case 'exit_desc':
                $services = $services->orderByDesc('exit_date_time');
                break;
            case 'exit_asc':
                $services = $services->orderBy('exit_date_time');
                break;
            default:
                $services = $services->orderBy($request->orderBy ?? 'id');
                break;
        }

        $services = $services->paginate($request->perPage ?? 5);

        return [
            'services' => $services
        ];
    }
}

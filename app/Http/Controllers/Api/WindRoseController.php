<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArchiveRequest;
use App\Http\Resources\WindRoseResource;
use App\Services\OpenMeteo\Client;

class WindRoseController extends Controller
{
    public function show(ArchiveRequest $request)
    {
        $data = $request->validated();
        $period = $data['period'];
        unset($data['period']);
        $end_date = now()->startOfMonth();
        $start_date = $end_date->clone()->subYears($period);

        $client = new Client();

        $data['start_date'] = $start_date->format('Y-m-d');
        $data['end_date'] = $end_date->format('Y-m-d');
        $data['daily'] = 'wind_speed_10m_max,wind_direction_10m_dominant';
        $data['wind_speed_unit'] = 'ms';

        return WindRoseResource::make($client->archive($data));
    }
}

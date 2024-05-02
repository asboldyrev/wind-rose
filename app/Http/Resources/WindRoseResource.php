<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WindRoseResource extends JsonResource
{
    protected array $cardinals = [
        'N', 'NNE', 'NE', 'ENE',
        'E', 'ESE', 'SE', 'SSE',
        'S', 'SSW', 'SW', 'WSW',
        'W', 'WNW', 'NW', 'NNW'
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $months = [];

        foreach ($this->daily->time as $index => $time) {
            $month = Carbon::createFromFormat('Y-m-d', $time)->month;

            $months[$month][] = [
                'speed' => $this->daily->wind_speed_10m_max[$index],
                'direction' => $this->daily->wind_direction_10m_dominant[$index],
            ];
        }

        ksort($months);

        $result = [];
        foreach ($months as $month => $data) {
            $result['direction'][$month] = $this->getDirection($data);
            $result['speed'][$month] = $this->getMaxSpeed($data);
        }

        $year = [
            'direction' => [],
            'speed' => [],
        ];

        foreach ($result['direction'] as $data) {
            foreach ($data as $index => $_direction) {
                if (!key_exists($index, $year['direction'])) {
                    $year['direction'][$index] = 0;
                }

                $year['direction'][$index] += $_direction;
            }
        }

        foreach ($result['speed'] as $data) {
            foreach ($data as $index => $speed) {
                if (!key_exists($index, $year['speed'])) {
                    $year['speed'][$index] = 0;
                }

                if ($year['speed'][$index] < $speed) {
                    $year['speed'][$index] = $speed;
                }
            }
        }

        $result['year'] = $year;

        return $result;
    }

    protected function getDirection(array $data)
    {
        $result = array_fill(0, 16, 0);

        foreach ($data as $wind) {
            $index = round($wind['direction'] / 22.5) % 16;

            $result[$index]++;
        }

        return $result;
    }

    protected function getMaxSpeed(array $data)
    {
        $result = array_fill(0, 16, 0);

        foreach ($data as $wind) {
            $index = round($wind['direction'] / 22.5) % 16;

            if ($result[$index] < $wind['speed']) {
                $result[$index] = $wind['speed'];
            }
        }

        return $result;
    }
}

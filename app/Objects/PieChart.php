<?php

namespace App\Objects;

class PieChart
{
    public array $colors;

    public function __construct(
        public string $title,
        public array $labels,
        public array $data
    ) {
        $this->colors = [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(153, 102, 255)',
            'rgb(255, 159, 64)',
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
        ];
    }

    public function build(): array
    {
        return [
            'labels' => $this->labels,
            'datasets' => [
                [
                    'label' => $this->title,
                    'data' => $this->data,
                    'backgroundColor' => $this->colors,
                    'hoverOffset' => 4,
                ],
            ],
        ];
    }
}

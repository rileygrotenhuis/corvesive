<?php

namespace App\Objects;


class PieChart
{
    public array $BACKGROUND_COLORS = [
        'rgba(255, 99, 132)',
        'rgba(255, 159, 64)',
        'rgba(255, 205, 86)',
        'rgba(75, 192, 192)',
        'rgba(54, 162, 235)',
        'rgba(153, 102, 255)',
        'rgba(201, 203, 207)',
    ];

    public function __construct(
        public array $labels,
        public array $data
    ) {
    }

    public function build(): array
    {
        $datasets = array_map(function ($data) {
            return [
                'label' => $data['label'],
                'data' => $data['data'],
                'backgroundColor' => $this->BACKGROUND_COLORS,
                'hoverOffset' => 4,
            ];
        }, $this->data);

        return [
            'labels' => $this->labels,
            'datasets' => $datasets,
        ];
    }

    public function validate(): bool
    {
        return $this->validateLabels() && $this->validateData();
    }

    protected function validateLabels(): bool
    {
        foreach ($this->labels as $label) {
            if (! is_string($label)) {
                return false;
            }
        }

        return true;
    }

    protected function validateData(): bool
    {
        foreach ($this->data as $chartData) {
            if (! is_string($chartData['label'])) {
                return false;
            }

            if (! is_array($chartData['data'])) {
                return false;
            }

            foreach ($chartData['data'] as $data) {
                if (! is_numeric($data)) {
                    return false;
                }
            }
        }

        return true;
    }
}

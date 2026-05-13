<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class IncomeChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Transaksi';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public ?string $filter = 'bulanan';

    protected function getFilters(): ?array
    {
        return [
            'harian' => 'Harian (7 Hari Terakhir)',
            'bulanan' => 'Bulanan (Tahun Ini)',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $data = [];
        $labels = [];

        if ($activeFilter === 'harian') {
            $label = 'Total Transaksi Harian';
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $labels[] = $date->translatedFormat('D, d M');
                $data[] = Transaction::whereDate('created_at', $date->toDateString())->count();
            }
        } else {
            $label = 'Total Transaksi Bulanan';
            $year = Carbon::now()->year;
            for ($i = 1; $i <= 12; $i++) {
                $date = Carbon::createFromDate($year, $i, 1);
                $labels[] = $date->translatedFormat('M Y');
                $data[] = Transaction::whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->count();
            }
        }

        return [
            'datasets' => [
                [
                    'label' => $label,
                    'data' => $data,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.2)', // Indigo 20%
                    'borderColor' => '#6366f1', // Indigo
                    'tension' => 0.5, // Kurva mulus
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,
                        'precision' => 0,
                    ],
                    'beginAtZero' => true,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

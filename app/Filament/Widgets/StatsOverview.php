<?php

namespace App\Filament\Widgets;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $revenue = Transaction::sum('grand_total_amount') ?? 0;

        return [
            Stat::make('Total Pendapatan', 'Rp '.number_format($revenue, 0, ',', '.'))
                ->description('Total keseluruhan transaksi')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success')
                ->url(route('filament.admin.resources.transactions.index')),

            Stat::make('Total Transaksi', Transaction::count())
                ->description('Pesanan yang masuk')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->chart([3, 5, 2, 7, 5, 8, 12])
                ->color('info')
                ->url(route('filament.admin.resources.transactions.index')),

            Stat::make('Total Produk', Product::count())
                ->description('Katalog produk tersedia')
                ->descriptionIcon('heroicon-m-cube')
                ->chart([1, 2, 3, 3, 4, 4, 5])
                ->color('primary')
                ->url(route('filament.admin.resources.products.index')),

            Stat::make('Total Kategori', Category::count())
                ->description('Kategori produk')
                ->descriptionIcon('heroicon-m-folder')
                ->color('warning')
                ->url(route('filament.admin.resources.categories.index')),

            Stat::make('Total Brand', Brand::count())
                ->description('Merek produk')
                ->descriptionIcon('heroicon-m-tag')
                ->color('danger')
                ->url(route('filament.admin.resources.brands.index')),

            Stat::make('Total Pengguna', User::count())
                ->description('Akun terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray')
                ->url(route('filament.admin.resources.users.index')),
        ];
    }
}

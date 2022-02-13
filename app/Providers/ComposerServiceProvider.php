<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductName;
use App\ProductMake;
use App\ProductModel;
use App\SalesInvoice;
use App\Customer;
use App\User;
use App\DealerInformation;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    { 

        view()->composer('dashboard', function($view){
            // daily sales
            $sales1 = SalesInvoice::where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
            $daily_sales = [];

            foreach( $sales1 as $sales){

                array_push($daily_sales, $sales->invoice_total);
            }

            $daily_sales =  number_format(array_sum($daily_sales));
            // Monthly sales
            $sales2 = SalesInvoice::where('created_at', 'like', '%'.date('Y-m').'%')->get();
            $monthly_sales = [];

            foreach( $sales2 as $sales){

                array_push($monthly_sales, $sales->invoice_total);
            }

            $monthly_sales =  number_format(array_sum($monthly_sales));
            

            return $view->with(['daily_sales' => $daily_sales, 'monthly_sales' => $monthly_sales]);

        });   

        view()->composer('layouts.main', function($view){

            $app_name = DealerInformation::pluck('app_name');

            return $view->with('app_name', $app_name);

        });

        view()->composer('layouts.app', function($view){

            $app_name = DealerInformation::pluck('app_name');

            return $view->with('app_name', $app_name);

        });
                         // View   // callback
        view()->composer('options.index', function($view){

            $products_name = ProductName::paginate(20);

            return $view->with('products_name', $products_name);

        });

        view()->composer('options.make', function($view){

            $products_make = ProductMake::paginate(20);

            return $view->with('products_make', $products_make);

        });

        view()->composer('options.model', function($view){

            $products_model = ProductModel::paginate(20);

            return $view->with('products_model', $products_model);

        });

        view()->composer('customers.index', function($view){

            $customers = Customer::paginate(20);

            return $view->with('customers', $customers);

        });

        view()->composer('users.index', function($view){

            $users = User::all();

            return $view->with('users', $users);

        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

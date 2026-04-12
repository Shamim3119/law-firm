<?php

 
namespace App\Helpers;


class MyHelper
{
    public static function get_toast_dispatch()
    {
        return "<script>
                    document.addEventListener('show-toast', (event) => {
                    document.getElementById('messageToast').innerText = event.detail.message;
                    const toastElement = document.getElementById('successToast');
                    const toast = new bootstrap.Toast(toastElement);
                    toast.show();
                });
                </script>

            <div class='position-fixed top-0 end-0 mt-5 p-3' style='z-index: 11'>
                <div id='successToast' class='toast text-bg-success' role='alert' aria-live='assertive' aria-atomic='true'>
                    <div class='toast-header'>
                        <strong class='me-auto'>Success</strong>
                        <small>just now</small>
                        <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
                    </div>
                    <div class='toast-body' id='messageToast'>
                        Hello, world!
                    </div>
                </div>
            </div>";
    }


    public static function get_toast_global()
    {
        return "<script>
            document.addEventListener('DOMContentLoaded', function () {
                if ('".session()->has('message')."' == '1') {
                    document.getElementById('toastMessage').innerText = '".session('message')."';
                    const toastElement = document.getElementById('toastSuccess');
                    const toast = new bootstrap.Toast(toastElement);
                    toast.show();
                }
            });
        </script>

        <div class='position-fixed top-0 end-0 mt-5 p-3' style='z-index: 12'>
            <div id='toastSuccess' class='toast text-bg-success' role='alert' aria-live='assertive' aria-atomic='true'>
                <div class='toast-header'>
                    <strong class='me-auto'>Success</strong>
                    <small>just now</small>
                    <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
                </div>
                <div class='toast-body' id='toastMessage'>
                    Hello, world!
                </div>
            </div>
        </div>";
    }
 
    public static function get_status_button($id, $name)
    {
        switch($id)
        {
            case 1:
                    return '<button type="button" class="btn btn-sm btn-primary">$name</button>';
                break;
            case 2:
                    return '<button type="button" class="btn btn-sm btn-warning">$name</button>';
                break;
            case 3:
                return '<button type="button" class="btn btn-sm btn-info">$name</button>';
                break;
            case 4:
                return '<button type="button" class="btn btn-sm btn-danger">$name</button>';
                break;
            case 5:
                return '<button type="button" class="btn btn-sm btn-success">$name</button>';
                break;
        }
    }

}
<!-- create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ __('Create Transaction') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="paid" class="col-md-4 col-form-label text-md-right">{{ __('Paid') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="paid" id="paid" class="form-check-input">
                                    <label for="paid" class="form-check-label">{{ __('Paid') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expired" class="col-md-4 col-form-label text-md-right">{{ __('Expired') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="expired" id="expired" class="form-check-input">
                                    <label for="expired" class="form-check-label">{{ __('Expired') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Transaction') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#paid, #expired').change(function() {
            var is_paid = $('#paid').is(':checked');
            var is_expired = $('#expired').is(':checked');
            var is_flagged = 0;

            if (is_paid || is_expired) {
                is_flagged = 1;
            }

            $.ajax({
                url: "{{ route('transactions.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "paid": is_paid,
                    "expired": is_expired,
                    "is_flagged": is_flagged
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

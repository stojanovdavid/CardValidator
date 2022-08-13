@extends('layouts.app')

@section('content')
<div class="padding">
    <div class="row">
        <div class="col-sm-6">
            @if (session('success'))
                <div class="text-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('store') }}">
                @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <strong>Credit Card</strong>
                        <small>enter your card details</small>
                    </div>
                    <select name="card_type"class="btn btn-primary @error('card_type') border border-danger bg-white text-dark @enderror">
                        <option value="" default>Select a card</option>
                        <option value="default">Default Card</option>
                        <option value="american">American Card</option>
                    </select>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('full_name') border border-danger @enderror" id="full_name" name="full_name" type="text" placeholder="Enter your name">
                                        <div class="text-danger">
                                            @error('full_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="ccnumber">Credit Card Number</label>


                                    <div class="input-group">
                                        <input class="form-control @error('card_number') border border-danger @enderror" type="text" id="card_number" name="card_number" placeholder="0000 0000 0000 0000" autocomplete="email">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                    @if (session('luhn_validation'))
                                    <div class="text-danger">
                                        {{ session('luhn_validation') }}
                                    </div>
                                    @endif
                                    @if (session('PAN_error'))
                                        <div class="text-danger">
                                            {{ session('PAN_error') }}
                                        </div>
                                    @endif
                                    @if (session('PAN_error_length'))
                                    <div class="text-danger">
                                        {{ session('PAN_error_length') }}
                                    </div>
                                    @endif
                                    
                                    <div class="row pb-3">
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="ccmonth">Month</label>
                                                    <select class="form-control" id="ccmonth" name="ccmonth">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="ccyear">Year</label>
                                                    <select class="form-control" id="ccyear" name="ccyear">
                                                        <option>2014</option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                        <option>2018</option>
                                                        <option>2019</option>
                                                        <option>2020</option>
                                                        <option>2021</option>
                                                        <option>2022</option>
                                                        <option>2023</option>
                                                        <option>2024</option>
                                                        <option>2025</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <div>
                                                <label for="cvv">CVV/CVC</label>
                                            <input class="form-control @error('cvv') border border-danger @enderror" id="cvv" name="cvv" type="text" placeholder="123">
                                            <div class="text-danger">
                                                @if (session('cvv_error'))
                                                    {{ session('cvv_error') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (session('message'))
                            <div class="text-danger">
                                {{ session('message') }}
                            </div>
                             @endif

                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="action" id="action" value="insert">
                        <button class="btn btn-sm btn-success float-right" type="submit" name="submit" id="submit">
                        <i class="mdi mdi-gamepad-circle"></i> Continue</button>
                        <button class="btn btn-sm btn-danger" type="reset">
                        <i class="mdi mdi-lock-reset"></i> Reset</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
</div>
@endsection

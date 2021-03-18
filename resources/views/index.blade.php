<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!-- Styles -->
{{--        <style>--}}
{{--	        .send-button{--}}
{{--		        background: #54C7C3;--}}
{{--		        width:100%;--}}
{{--		        font-weight: 600;--}}
{{--		        color:#fff;--}}
{{--		        padding: 8px 25px;--}}
{{--	        }--}}

{{--	        .my-input{--}}
{{--		        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);--}}
{{--		        cursor: text;--}}
{{--		        padding: 8px 10px;--}}
{{--		        transition: border .1s linear;--}}
{{--	        }--}}

{{--	        .header-title{--}}
{{--		        margin: 5rem 0;--}}
{{--	        }--}}

{{--	        h1{--}}
{{--		        font-size: 31px;--}}
{{--		        line-height: 40px;--}}
{{--		        font-weight: 600;--}}
{{--		        color:#4c5357;--}}
{{--	        }--}}

{{--	        h2{--}}
{{--		        color: #5e8396;--}}
{{--		        font-size: 21px;--}}
{{--		        line-height: 32px;--}}
{{--		        font-weight: 400;--}}
{{--	        }--}}

{{--	        @media screen and (max-width:480px){--}}
{{--		        h1{ font-size: 26px; }--}}
{{--		        h2{ font-size: 20px; }--}}
{{--	        }--}}
{{--        </style>--}}
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 mx-auto text-center">
                <div class="header-title">
                    <h1 class="wv-heading--title">
                        Invoice Calculator
                    </h1>
                    <h2 class="wv-heading--subtitle">
                        Fill the form to calculate your data
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="myform form">
                        <form method="POST" action="{{ route('calculate') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="uploadFile">Upload file <span class="text-danger">*</span></label>
                                <input type="file" class="form-control pt-1" name="uploadFile" id="uploadFile" required>
                                <span class="text-danger">{{ $errors['uploadFile'] ?? '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="firstExchangeRate">Exchange Rate <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text firstCurrency">USD</div>
                                    </div>
                                    <input type="text" class="firstCurrencyExch d-none" name="firstCurrencyExch" value="USD">
                                    <input type="text" class="form-control my-input firstExchangeRate" name="firstExchangeRate" id="firstExchangeRate" required>
                                </div>
                                <span class="text-danger">{{ $errors['firstExchangeRate'] ?? '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="secondExchangeRate">Exchange Rate <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text secondCurrency">GBP</div>
                                    </div>
                                    <input type="text" class="secondCurrencyExch d-none" name="secondCurrencyExch" value="GBP">
                                    <input type="text" class="form-control my-input secondExchangeRate" name="secondExchangeRate" id="secondExchangeRate" required>
                                </div>
                                <span class="text-danger">{{ $errors['secondExchangeRate'] ?? '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="outputCurrency">Output currency <span class="text-danger">*</span></label>
                                <select class="form-control my-input outputCurrency" name="outputCurrency" id="outputCurrency" required>
                                    @foreach($supportedCurrencies as $currency)
                                        <option value="{{ $currency }}">{{ $currency }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors['outputCurrency'] ?? '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="vatNumber">VAT number</label>
                                <input type="number" name="vatNumber" id="vatNumber" class="form-control my-input" placeholder="VAT Number">
                                <span class="text-danger">{{ $errors['vatNumber'] ?? '' }}</span>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-block send-button tx-tfm">Calculate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if( isset($total) && $total !== 0 )
            <div class="col-md-6 mx-auto text-center">
                <h1> Total : {{ $total .' ' . $outputCurrency }}</h1>
            </div>
            @endif
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('js/index.js')}}" type="text/javascript"></script>
</html>

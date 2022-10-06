@extends('app')
@section('content')

@if (isset($user))
    <form action="{{ route('user.update', $user) }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('user.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('user.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white"><i class="fa-solid fa-user"></i>&nbsp; User</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-12 text-center">
                <img
                    width="200px"
                    src="/images/user/defaultPhoto.png"
                    class="rounded mx-auto d-block"
                    alt="{{ $user->name ?? '' }}"
                >
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                @include('components.input', ['name' => 'name', 'required' => true, 'value' => $user->name ?? old('name') ])
            </div>
            <div class="col-md-2">
                @include('components.input', ['name' => 'birthdate', 'required' => true, 'type' => 'date', 'value' => $user->birthdate ?? old('birthdate') ])
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @include('components.input', ['name' => 'email', 'required' => true, 'label' => 'E-mail', 'type' => 'email', 'value' => $user->email ?? old('email') ])
            </div>
            <div class="col-md-6">
                @include('components.input', ['name' => 'password', 'required' => true, 'type' => 'password', 'value' => $user->password ?? old('password') ])
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="Country">Country</label>
                <select class="countries" name="country" required>
                    <option value="{{ old('country') }}">{{ old('country') }}</option>
                    @if (isset($user) && $user->country)
                        <option value="{{ $user->country }}" selected>{{ $user->country }}</option>
                    @endif
                </select>
            </div>
            <div class="col-md-3">
                <label for="City">City</label>
                <select class="cities" name="city" required>
                    <option value="{{ old('city') }}">{{ old('city') }}</option>
                    @if (isset($user) && $user->city)
                        <option value="{{ $user->city }}" selected>{{ $user->city }}</option>
                    @endif
                </select>
            </div>
            <div class="col-md-3">
                @include('components.input', ['name' => 'address', 'required' => true, 'value' => $user->address ?? old('address') ])
            </div>
            <div class="col-md-3">
                @include('components.input', ['name' => 'postcode', 'required' => true, 'value' => $user->postcode ?? old('postcode') ])
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                @include('components.input', ['name' => 'phone', 'required' => true, 'value' => $user->phone ?? old('phone') ])
            </div>
            <div class="col-md-3">
            @include('components.input', ['name' => 'cellphone', 'value' => $user->cellphone ?? old('cellphone') ])
            </div>
            <div class="col-md-3">
                @include('components.input', ['name' => 'remuneration', 'type' => 'number', 'value' => $user->remuneration ?? old('remuneration') ])
            </div>
            <div class="col-md-3">
                @include('components.input', ['name' => 'currency', 'value' => $user->currency ?? old('currency') ])
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @include('components.buttonSubmit', ['name' => 'Save'])
    </div>
    @if (isset($user))
        <div class="col-md-6" align="right">
            @include('components.buttonDelete', ['urlDestroy' => route('api.user.destroy', $user), 'urlRedirect' => route('user.index')])
        </div>
    @endif
</div>

</form>

<script src="/js/resourceDestroy.js"></script>

<script>
    // select2
    $(document).ready(function() {
        $('.countries').select2({
            ajax: {
                url: 'https://restcountries.com/v3.1/all',
                dataType: 'json',
                delay: 250,
                processResults: function (response, search) {
                    return {
                        results: $.map(response, function (option) {
                            if (search.term != undefined) {
                                if (option.name.common.toLowerCase().includes(search.term.toLowerCase())) {
                                    return {
                                        id: option.name.common,
                                        text: option.name.common
                                    }
                                }
                            } else {
                                return {
                                    id: option.name.common,
                                    text: option.name.common
                                }
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('.cities').select2({
            tags: true,
            ajax: {
                url: 'https://restcountries.com/v3.1/all',
                dataType: 'json',
                delay: 250,
                processResults: function (response, search) {
                    return {
                        results: $.map(response, function (option) {
                            if (search.term != undefined) {
                                if (option.name.common.toLowerCase().includes(search.term.toLowerCase())) {
                                    return {
                                        id: option.name.common,
                                        text: option.name.common
                                    }
                                }
                            } else {
                                return {
                                    id: option.name.common,
                                    text: option.name.common
                                }
                            }
                        })
                    };
                },
                createTag: function (newCity) {
                    var city = $.trim(newCity.term);

                    return {
                        id: city,
                        text: city,
                        newTag: true
                    }
                },
                cache: true
            }
        });

        $('.groups').select2({});
    });
</script>

@endsection
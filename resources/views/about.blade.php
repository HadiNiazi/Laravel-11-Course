
@extends('layouts.site')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">

            <div class="card">
                <div class="card-header bg-info">
                  About us
                </div>
                <div class="card-body">
                  <p class="card-text">Welcome to the about us page.</p> <br>

                  {{-- <p>My name is {{ $name }} </p> --}}

                  {{-- @if($name == 'Hadayat Niazi')
                    Yes it is my name.
                  @endif

                  @if($name == 'Hadi')
                    No my name is Hadi.
                  @endif --}}


                {{-- @empty(!$name)

                  @if($name == 'Hadayat Niazi')
                    Yes it is my name.
                  @elseif($name == 'Hadayat Niazi a')
                    No my name is bit different.
                  @else
                   Not at all.
                  @endif

                @endempty --}}


                {{-- @if($name == 'Hadi')
                    @if($name === 'Hadi')
                        No my name is Hadi.
                    @endif
                @endif --}}


                {{-- @switch($name)

                   @case('Had')
                    Had
                   @break

                   @case('Hadiiiii')
                    Hadi
                   @break

                   @default

                     No condition executed

                @endswitch --}}

                {{-- I am comment  --}}


                  <ul>
                    {{-- @for($i = 0; $i < 5; $i++)

                       <li>{{ $i }}</li>

                    @endfor --}}

                    {{-- @php
                        $i = 0;
                    @endphp --}}

                    {{-- @while($i < 3)
                        <li>{{ $names[$i] }}</li>

                        @php
                          $i++
                        @endphp
                    @endwhile --}}


                    {{-- @if(count($names) > 0)

                        @foreach($names as $key => $fname)
                            <li>{{ $fname }}</li>
                        @endforeach

                    @else
                        Array is empty.
                    @endif --}}

                    {{-- @forelse ($names as $name)
                        <li>{{ $name }}</li>
                    @empty
                        Array is empty through forelse.
                    @endforelse --}}

                  </ul>



                </div>
            </div>

        </div>
    </div>
</div>

@endsection





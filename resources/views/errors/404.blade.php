@extends('layouts.old_app')

@section('content')

    <div class="col-md-2">
        @include('partials.old_vertical_navigation')
    </div>
    <style>
        html {
            --mouse-x: 0.5;
            --mouse-y: 0.5;
        }

        .phantom {
            --color: #e91e63;
            --size: 10rem;
            background-color: var(--color);
            width: 1em;
            height: 0.9em;
            font-size: var(--size);
            display: inline-block;
            position:relative;
            border-radius: 0.5em 0.5em 0 0;
            box-shadow: inset -0.1em 0.02em rgba(0,0,0,0.1);
            margin-top:0.35em;
            margin-bottom:0.35em;
            will-change: transform;
            animation: float alternate infinite 2s ease-in-out;
        }

        .legs::before,
        .legs::after,
        .legs {
            display: block;
            background-color: inherit;
            width: 0.42em;
            height: 0.25em;
            border-radius: 0 0 0.2em 0.2em;
        }

        .legs {
            transform: translate3d(0.29em, -1px, 0);
        }

        .legs::before {
            content: ' ';
            transform: translate3d(-0.29em, 0, 0);
            width: 0.3em;
            border-radius: 0 0 0.15em 0.15em;
        }

        .legs::after {
            content: ' ';
            transform: translate3d(0.41em, -100%, 0);
            width: 0.3em;
            border-radius: 0 0 0.15em 0.15em;
            box-shadow: inset -3em 0 0 -2.9em rgba(0,0,0,0.1);
        }

        .body {
            box-sizing: border-box;
            padding-top:0.05em;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .body::after,
        .body::before {
            content: ' ';
            width: 0.7em;
            margin: 0.3em;
            margin-top: 1.3em;
            height: 1.2em;
            font-size: 0.2em;
            background-color: #ffa7be;
            border-radius: 0.5em;
            position: relative;
        }

        .eye {
            width: 1em;
            height: 1em;
            font-size: 0.4em;
            background-color: white;
            border-radius: 50%;
            position: relative;
            box-shadow: 0.03em 0.14em rgba(0,0,0,0.1);
            animation: blink forwards infinite 10s ease-in-out;
        }

        .pupil {
            position: absolute;
            content: ' ';
            width: 0.6em;
            height: 0.6em;
            border-radius: 50%;
            background-color: black;
            will-change: transform;
            transition: transform 200ms ease-in-out;
            transform: translateX(calc(var(--mouse-x) * 0.2em + 0.1em)) translateY(calc(var(--mouse-y) * 0.2em + 0.1em));
        }

        html:hover .pupil {
            transition: none;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(0.1em); }
        }

        @keyframes blink {
            0%, 2%, 60%, 62%, 100% { transform: scaleX(1) scaleY(1); }
            1%, 61% { transform: scaleX(1.3) scaleY(0.1); }
        }

    </style>

    <div class="container">
        <br/><br/><br/>
        <div class="row">
            <div class="col-sm-10">
                <div class="container" style="text-align:  center; border: solid 1px; border-radius: 10px;">
                    404  Тази страница беше преместена и вече не съществува!
                    След 5 секунди ще бъдеш прехвърлен към
                    <a href="/">началната страница.</a>
                    <br/>
                    <div class="phantom">
                        <div class="body">
                            <div class="eye">
                                <div class="pupil"></div>
                            </div>
                        </div>
                        <div class="legs"></div>
                    </div>
                    <h1>Boooo!</h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        const root = document.documentElement;

        document.addEventListener('mousemove', e => {
            let x = e.clientX / window.innerWidth;
        let y = e.clientY / window.innerHeight;

        root.style.setProperty('--mouse-x', x);
        root.style.setProperty('--mouse-y', y);
        });

        document.addEventListener('mouseleave', e => {
            root.style.removeProperty('--mouse-x');
        root.style.removeProperty('--mouse-y');
        });
    </script>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – GKS Kanatang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --forest:      #1a3d2b;
            --forest-mid:  #224d36;
            --forest-lite: #2d6645;
            --gold:        #c9a84c;
            --gold-light:  #e8c97a;
            --cream:       #f5f0e8;
            --text-dim:    rgba(245,240,232,0.55);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background-color: var(--forest);
            background-image:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(45,102,69,.7) 0%, transparent 70%),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60'%3E%3Cpath d='M0 30 Q15 10 30 30 Q45 50 60 30' fill='none' stroke='rgba(201,168,76,.06)' stroke-width='1'/%3E%3C/svg%3E");
            font-family: 'Lato', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Decorative cross behind the card */
        body::before {
            content: '';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 340px;
            height: 340px;
            background:
                linear-gradient(var(--forest-mid) 0%, var(--forest-mid) 100%) center/12px 100% no-repeat,
                linear-gradient(var(--forest-mid) 0%, var(--forest-mid) 100%) center/100% 12px no-repeat;
            opacity: .18;
            border-radius: 2px;
            pointer-events: none;
        }

        /* Leaf / vine corner ornament */
        body::after {
            content: '';
            position: fixed;
            bottom: -80px;
            right: -80px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            border: 2px solid rgba(201,168,76,.12);
            box-shadow:
                0 0 0 30px rgba(201,168,76,.05),
                0 0 0 70px rgba(201,168,76,.03);
            pointer-events: none;
        }

        /* ── Card ─────────────────────────────── */
        .login-card {
            position: relative;
            width: 100%;
            max-width: 430px;
            background: linear-gradient(160deg, rgba(34,77,54,.92) 0%, rgba(22,50,35,.97) 100%);
            border: 1px solid rgba(201,168,76,.25);
            border-radius: 4px;
            padding: 2.8rem 2.5rem 2.5rem;
            box-shadow:
                0 0 0 1px rgba(201,168,76,.08),
                0 20px 60px rgba(0,0,0,.45),
                0 2px 8px rgba(0,0,0,.3);
            animation: fadeUp .6s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Gold top bar */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            border-radius: 0 0 2px 2px;
        }

        /* ── Header ───────────────────────────── */
        .church-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .cross-icon {
            width: 52px;
            height: 52px;
            position: relative;
            margin-bottom: .9rem;
        }
        .cross-icon::before,
        .cross-icon::after {
            content: '';
            position: absolute;
            background: linear-gradient(180deg, var(--gold-light), var(--gold));
            border-radius: 2px;
        }
        .cross-icon::before {
            top: 0; bottom: 0;
            left: 50%; transform: translateX(-50%);
            width: 10px;
        }
        .cross-icon::after {
            left: 0; right: 0;
            top: 28%; transform: translateY(-50%);
            height: 10px;
        }

        .church-name {
            font-family: 'Cinzel', serif;
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: .08em;
            color: var(--gold-light);
            text-align: center;
            line-height: 1.3;
        }

        .church-sub {
            font-size: .75rem;
            font-weight: 300;
            letter-spacing: .22em;
            color: var(--text-dim);
            text-transform: uppercase;
            margin-top: .35rem;
            text-align: center;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: .7rem;
            margin: 1.4rem 0 1.8rem;
            color: rgba(201,168,76,.4);
            font-size: .65rem;
            letter-spacing: .18em;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.3), transparent);
        }

        /* ── Form ─────────────────────────────── */
        .form-label {
            color: var(--gold-light);
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: .45rem;
        }

        .form-control {
            background: rgba(255,255,255,.05) !important;
            border: 1px solid rgba(201,168,76,.22) !important;
            border-radius: 3px;
            color: var(--cream) !important;
            padding: .65rem .9rem;
            font-family: 'Lato', sans-serif;
            font-size: .92rem;
            transition: border-color .25s, box-shadow .25s, background .25s;
        }
        .form-control::placeholder { color: rgba(245,240,232,.28); }
        .form-control:focus {
            background: rgba(255,255,255,.08) !important;
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 3px rgba(201,168,76,.14) !important;
            outline: none;
        }

        .text-danger.small { color: #f4a070 !important; font-size: .78rem; }

        /* ── Submit button ────────────────────── */
        .btn-masuk {
            width: 100%;
            padding: .75rem;
            background: linear-gradient(135deg, var(--forest-lite), var(--forest-mid));
            border: 1px solid var(--gold);
            border-radius: 3px;
            color: var(--gold-light);
            font-family: 'Cinzel', serif;
            font-size: .88rem;
            font-weight: 600;
            letter-spacing: .15em;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: .5rem;
            transition: background .25s, box-shadow .25s, color .25s, transform .1s;
            position: relative;
            overflow: hidden;
        }
        .btn-masuk::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(201,168,76,.18), transparent);
            opacity: 0;
            transition: opacity .25s;
        }
        .btn-masuk:hover {
            background: linear-gradient(135deg, #377a52, var(--forest-lite));
            box-shadow: 0 4px 20px rgba(201,168,76,.22);
            color: #fff;
            transform: translateY(-1px);
        }
        .btn-masuk:hover::after { opacity: 1; }
        .btn-masuk:active { transform: translateY(0); }

        /* ── Footer note ──────────────────────── */
        .login-footer {
            text-align: center;
            margin-top: 1.6rem;
            color: var(--text-dim);
            font-size: .72rem;
            letter-spacing: .06em;
        }
    </style>
</head>

<body>

<div class="login-card">

    <!-- Logo & Nama -->
    <div class="church-logo">
        <div class="cross-icon"></div>
        <div class="church-name">GKS Kanatang</div>
        <div class="church-sub">Gereja Kristen Sumba</div>
    </div>

    <div class="divider">Sistem Pengurus</div>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Username -->
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required
                   class="form-control" placeholder="Masukkan username">
            @error('username')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" required
                   class="form-control" placeholder="Masukkan password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-masuk">Masuk</button>
    </form>

    <div class="login-footer">
        &copy; {{ date('Y') }} GKS Kanatang &mdash; Hak Cipta Dilindungi
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
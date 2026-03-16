@extends('layouts.app')

@section('title', 'BARE - Healthy Bowls & More')

@section('head')
    <style>
        .hero {
            padding: 26px 0 32px;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
            gap: 32px;
            align-items: center;
        }
        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 5px 12px 5px 6px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(46, 125, 50, 0.16);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.04);
            font-size: 11px;
            color: #1B5E20;
            margin-bottom: 16px;
        }
        .hero-chip-dot {
            width: 20px;
            height: 20px;
            border-radius: 999px;
            background: radial-gradient(circle at 25% 25%, #A5D6A7, #2E7D32);
            position: relative;
        }
        .hero-chip-dot::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: inherit;
            border: 2px solid rgba(245, 240, 230, 0.9);
        }
        .hero-title {
            font-family: 'Poppins', system-ui, sans-serif;
            font-weight: 700;
            font-size: clamp(32px, 4vw, 40px);
            line-height: 1.1;
            color: #1B4332;
            margin-bottom: 12px;
        }
        .hero-title span.accent {
            color: #2E7D32;
        }
        .hero-subtitle {
            font-size: 14px;
            line-height: 1.6;
            color: #616161;
            max-width: 460px;
            margin-bottom: 18px;
        }
        .hero-macros {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }
        .macro-pill {
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(158, 158, 158, 0.25);
            font-size: 11px;
        }
        .macro-pill strong {
            font-weight: 600;
            color: #1B5E20;
        }
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 14px;
        }
        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 11px;
            color: #9E9E9E;
        }
        .hero-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .hero-meta-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #2E7D32;
        }
        .hero-visual-wrapper {
            position: relative;
        }
        .hero-card {
            background: linear-gradient(135deg, #FFFFFF, #FDF7EF);
            border-radius: 28px;
            box-shadow: 0 18px 45px rgba(28, 49, 36, 0.12);
            padding: 18px 18px 16px;
            position: relative;
            overflow: hidden;
        }
        .hero-badge {
            position: absolute;
            top: 14px;
            right: 16px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(198, 40, 40, 0.06);
            color: #C62828;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .hero-bowl {
            position: relative;
            margin: 8px 0 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-bowl-circle {
            width: min(260px, 80vw);
            height: min(260px, 80vw);
            border-radius: 50%;
            background: radial-gradient(circle at 25% 15%, #FFE0B2, #F5F0E6 40%, #E8F5E9 100%);
            border: 10px solid #FFFFFF;
            box-shadow: 0 22px 35px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }
        .hero-bowl-layer {
            position: absolute;
            border-radius: 999px;
            filter: drop-shadow(0 10px 16px rgba(0, 0, 0, 0.12));
        }
        .hero-bowl-layer.green {
            width: 84%;
            height: 36%;
            background: radial-gradient(circle at 20% 20%, #C8E6C9, #2E7D32);
            bottom: 10%;
            left: 8%;
        }
        .hero-bowl-layer.orange {
            width: 40%;
            height: 26%;
            background: radial-gradient(circle at 20% 20%, #FFE0B2, #FB8C00);
            top: 28%;
            left: 10%;
            transform: rotate(-14deg);
        }
        .hero-bowl-layer.purple {
            width: 32%;
            height: 22%;
            background: radial-gradient(circle at 20% 20%, #F3E5F5, #7B1FA2);
            top: 26%;
            right: 10%;
            transform: rotate(18deg);
        }
        .hero-bowl-layer.white {
            width: 44%;
            height: 22%;
            background: radial-gradient(circle at 10% 10%, #FFFFFF, #F5F5F5);
            top: 48%;
            right: 22%;
            transform: rotate(-8deg);
        }
        .hero-bowl-ring {
            position: absolute;
            inset: 12%;
            border-radius: 50%;
            border: 2px dashed rgba(255, 255, 255, 0.55);
        }
        .hero-bowl-dot {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.16);
        }
        .hero-bowl-dot.dot-1 { top: 16%; left: 26%; }
        .hero-bowl-dot.dot-2 { top: 22%; right: 24%; }
        .hero-bowl-dot.dot-3 { bottom: 18%; left: 40%; }
        .hero-nutrition {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 10px;
        }
        .hero-cal-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            padding: 10px 12px;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.06);
            min-width: 140px;
        }
        .hero-cal-label {
            font-size: 11px;
            color: #9E9E9E;
            margin-bottom: 4px;
        }
        .hero-cal-value {
            font-family: 'Poppins', system-ui, sans-serif;
            font-weight: 600;
            font-size: 20px;
            color: #1B5E20;
        }
        .hero-cal-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 4px;
        }
        .hero-cal-chip {
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(232, 245, 233, 0.9);
            font-size: 10px;
            color: #2E7D32;
        }
        .hero-taglist {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 11px;
            color: #9E9E9E;
            text-align: right;
        }
        .hero-taglist span {
            display: inline-flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }
        .hero-tag-dot-green {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: radial-gradient(circle at 25% 25%, #C8E6C9, #2E7D32);
        }
        .sections {
            padding: 10px 0 36px;
        }
        .section-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1.1fr);
            gap: 24px;
            align-items: flex-start;
        }
        .section-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 22px;
            padding: 16px 18px 14px;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.06);
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .section-title {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #1B4332;
        }
        .section-subtitle {
            font-size: 12px;
            color: #9E9E9E;
        }
        .menu-scroll {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }
        .menu-card {
            background: #FFFFFF;
            border-radius: 18px;
            padding: 10px 10px 9px;
            border: 1px solid rgba(158, 158, 158, 0.18);
            cursor: pointer;
            transition: transform 0.12s ease, box-shadow 0.12s ease, border-color 0.12s ease, background 0.12s ease;
        }
        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 26px rgba(0, 0, 0, 0.08);
            border-color: rgba(46, 125, 50, 0.4);
        }
        .menu-tag {
            font-size: 10px;
            color: #1B5E20;
            background: rgba(46, 125, 50, 0.09);
            padding: 3px 7px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 6px;
        }
        .menu-img {
            border-radius: 14px;
            background: radial-gradient(circle at 20% 0, #FFE0B2, #E8F5E9);
            padding: 10px;
            margin-bottom: 8px;
            position: relative;
            overflow: hidden;
        }
        .menu-img-inner {
            height: 90px;
            border-radius: 999px;
            background: radial-gradient(circle at 20% 20%, #C8E6C9, #2E7D32);
            border: 7px solid #FFFFFF;
        }
        .menu-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 3px;
            color: #1B4332;
        }
        .menu-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #9E9E9E;
            margin-bottom: 5px;
        }
        .menu-price {
            font-size: 13px;
            font-weight: 600;
            color: #C62828;
        }
        .badge-hot {
            padding: 3px 7px;
            border-radius: 999px;
            background: rgba(198, 40, 40, 0.07);
            color: #C62828;
            font-size: 10px;
            font-weight: 600;
        }
        .menu-cta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }
        .menu-cta-row button { flex: 1; }
        .calorie-card {
            background: #FFFFFF;
            border-radius: 18px;
            padding: 12px 14px 10px;
            border: 1px solid rgba(158, 158, 158, 0.16);
        }
        .calorie-inputs {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            margin: 10px 0;
        }
        .field-label {
            font-size: 11px;
            color: #9E9E9E;
            margin-bottom: 3px;
        }
        .field {
            border-radius: 999px;
            border: 1px solid rgba(158, 158, 158, 0.45);
            padding: 6px 10px;
            font-size: 12px;
            width: 100%;
            outline: none;
            background: #FFFFFF;
        }
        .field:focus {
            border-color: #2E7D32;
            box-shadow: 0 0 0 1px rgba(46, 125, 50, 0.15);
        }
        .select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #9E9E9E 50%), linear-gradient(135deg, #9E9E9E 50%, transparent 50%);
            background-position: calc(100% - 14px) 50%, calc(100% - 10px) 50%;
            background-repeat: no-repeat;
            background-size: 6px 6px, 6px 6px;
        }
        .calorie-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #9E9E9E;
        }
        .calorie-target {
            font-family: 'Poppins', system-ui, sans-serif;
            font-weight: 600;
            color: #bd4823;
        }
        .membership-card {
            background: linear-gradient(145deg, #a63d1e, #bd4823);
            border-radius: 22px;
            padding: 16px 16px 14px;
            box-shadow: 0 22px 45px rgba(16, 65, 23, 0.22);
            color: #FFFFFF;
            overflow: hidden;
            position: relative;
        }
        .membership-ribbon {
            position: absolute;
            inset: -40px -40px auto auto;
            opacity: 0.16;
            background: radial-gradient(circle at top, #FDD835, transparent 55%);
        }
        .membership-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .membership-tier {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .membership-points {
            font-size: 12px;
        }
        .membership-progress {
            margin-top: 8px;
            margin-bottom: 10px;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            overflow: hidden;
            position: relative;
        }
        .progress-bar-inner {
            width: 58%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #fff3f0, #bd4823);
        }
        .membership-tiers {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            opacity: 0.9;
        }
        .membership-perks {
            margin-top: 8px;
            font-size: 11px;
        }
        .membership-perks ul {
            list-style: none;
            padding-left: 0;
        }
        .membership-perks li {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 3px;
        }
        .perk-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #fff3f0;
            flex: 0 0 8px;
            margin-top: 6px;
        }
        @media (max-width: 960px) {
            .hero-grid {
                grid-template-columns: minmax(0, 1fr);
            }
            .sections {
                padding-top: 4px;
            }
            .section-grid {
                grid-template-columns: minmax(0, 1fr);
            }
            .menu-scroll {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 768px) {
            .hero-title { font-size: 28px; }
        }
    </style>
@endsection

@section('content')
    <section class="hero">
        <div class="hero-grid">
            <div>
                <div class="hero-chip">
                    <div class="hero-chip-dot"></div>
                    Menu BARE · Poke · Salad · Grain · Smoothie Bowl
                </div>

                <h1 class="hero-title">
                    Xây bữa ăn <span class="accent">healthy</span><br>
                    chuẩn dinh dưỡng, <span class="accent">trong vài chạm.</span>
                </h1>

                <p class="hero-subtitle">
                    BARE mang tới những chiếc bowl tươi mới mỗi ngày: nguyên liệu sạch, cân bằng macros,
                    nhiều lựa chọn cho người giảm cân, tăng cơ hoặc đơn giản là muốn ăn lành mạnh hơn.
                </p>

                <div class="hero-macros">
                    <div class="macro-pill"><strong>Calories:</strong> hiển thị đầy đủ từng món</div>
                    <div class="macro-pill"><strong>Protein:</strong> ưu tiên nguồn sạch, ít béo</div>
                    <div class="macro-pill"><strong>Fiber:</strong> nhiều rau xanh &amp; ngũ cốc nguyên cám</div>
                </div>

                <div class="hero-actions">
                    <a href="{{ route('menu.index') }}" class="btn btn-accent">
                        Đặt bowl đầu tiên
                    </a>
                    <a href="{{ route('calories.index') }}" class="btn btn-outline">
                        Xây dựng bữa ăn của bạn
                    </a>
                </div>

                <div class="hero-meta">
                    <span><span class="hero-meta-dot"></span> Giao nhanh trong 30–40 phút khu vực nội thành</span>
                    <span><span class="hero-meta-dot" style="background:#FFA000;"></span> Tùy chỉnh topping, base theo mục tiêu cá nhân</span>
                </div>
            </div>

            <div class="hero-visual-wrapper">
                <div class="hero-card">
                    <div class="hero-badge">
                        Bestseller · <span id="hero-cal-badge">430 kcal</span>
                    </div>

                    <div class="hero-bowl">
                        <div class="hero-bowl-circle">
                            <div class="hero-bowl-layer green"></div>
                            <div class="hero-bowl-layer orange"></div>
                            <div class="hero-bowl-layer purple"></div>
                            <div class="hero-bowl-layer white"></div>
                            <div class="hero-bowl-ring"></div>
                            <div class="hero-bowl-dot dot-1"></div>
                            <div class="hero-bowl-dot dot-2"></div>
                            <div class="hero-bowl-dot dot-3"></div>
                        </div>
                    </div>

                    <div class="hero-nutrition">
                        <div class="hero-cal-card">
                            <div class="hero-cal-label">BARE Salmon Poke Bowl</div>
                            <div class="hero-cal-value" id="hero-cal-value">430 kcal</div>
                            <div class="hero-cal-chips">
                                <span class="hero-cal-chip" id="hero-protein-chip">Protein 28g</span>
                                <span class="hero-cal-chip" id="hero-carb-chip">Carb 42g</span>
                                <span class="hero-cal-chip" id="hero-fat-chip">Fat 14g</span>
                            </div>
                        </div>

                        <div class="hero-taglist">
                            <span><span class="hero-tag-dot-green"></span> Omega-3 từ cá hồi tươi</span>
                            <span><span class="hero-tag-dot-green"></span> Ít đường, nhiều chất xơ</span>
                            <span><span class="hero-tag-dot-green"></span> Phù hợp giảm mỡ, giữ dáng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sections" aria-label="Khám phá nhanh">
        <div class="section-grid">
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <div class="section-title">Menu nổi bật hôm nay</div>
                        <div class="section-subtitle">Healthy Rice Bowl · Salad Bowl · Grain Bowl</div>
                    </div>
                    <a href="{{ route('menu.index') }}" class="link-inline" style="font-size:11px;color:#2E7D32;text-decoration:underline;">
                        Xem toàn bộ menu &rarr;
                    </a>
                </div>

                <div class="menu-scroll" id="home-menu-preview">
                    @forelse($featuredProducts as $product)
                        <article class="menu-card" data-product-id="{{ $product->id }}">
                            <div class="menu-tag">
                                <span style="width:8px;height:8px;border-radius:999px;background:#2E7D32;"></span>
                                {{ $product->category?->name ?? 'Healthy Bowl' }}
                            </div>
                            <div class="menu-img">
                                <img src="{{ $product->image_src ?: asset('image/bare-logo.png') }}" alt="{{ $product->name }}" style="width: 100%; height: 90px; object-fit: cover; border-radius: 14px;">
                            </div>
                            <h3 class="menu-title">{{ $product->name }}</h3>
                            <div class="menu-meta">
                                <span>{{ $product->calories }} kcal · {{ $product->protein }}g protein</span>
                                <span class="menu-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="menu-cta-row">
                                <button class="btn btn-outline" type="button" data-id="{{ $product->id }}">
                                    Thêm vào giỏ
                                </button>
                                <span class="badge-hot">
                                    {{ $product->is_best_for_goal ?? 'Gợi ý hôm nay' }}
                                </span>
                            </div>
                        </article>
                    @empty
                        <!-- fallback mock nếu chưa có dữ liệu thật -->
                    @endforelse
                </div>
            </div>

            <div>
                <div class="calorie-card">
                    <div class="section-header" style="margin-bottom:6px;">
                        <div>
                            <div class="section-title" style="font-size:15px;">Tính nhanh calories / ngày</div>
                            <div class="section-subtitle">Dựa trên thông tin cơ bản của bạn</div>
                        </div>
                    </div>

                    <div class="calorie-inputs">
                        <div>
                            <div class="field-label">Giới tính</div>
                            <select id="quick-gender" class="field select">
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                            </select>
                        </div>
                        <div>
                            <div class="field-label">Tuổi</div>
                            <input id="quick-age" class="field" type="number" min="16" max="80" value="26">
                        </div>
                        <div>
                            <div class="field-label">Chiều cao (cm)</div>
                            <input id="quick-height" class="field" type="number" min="140" max="210" value="168">
                        </div>
                        <div>
                            <div class="field-label">Cân nặng (kg)</div>
                            <input id="quick-weight" class="field" type="number" min="40" max="130" value="58">
                        </div>
                        <div>
                            <div class="field-label">Hoạt động</div>
                            <select id="quick-activity" class="field select">
                                <option value="sedentary">Ít vận động</option>
                                <option value="lightly">Nhẹ (1–3 buổi/tuần)</option>
                                <option value="moderately">Vừa (3–5 buổi/tuần)</option>
                                <option value="very">Nhiều (6–7 buổi/tuần)</option>
                            </select>
                        </div>
                        <div>
                            <div class="field-label">Mục tiêu</div>
                            <select id="quick-goal" class="field select">
                                <option value="loss">Giảm cân</option>
                                <option value="maintain">Duy trì</option>
                                <option value="gain">Tăng cân</option>
                            </select>
                        </div>
                    </div>

                    <div class="calorie-footer">
                        <div>
                            Hôm nay bạn nên ăn khoảng<br>
                            <span class="calorie-target" id="quick-target-kcal">~ 1800 kcal / ngày</span>
                        </div>
                        <a href="{{ route('calories.index') }}" class="btn btn-outline" id="quick-calc-btn" style="padding-inline:14px;">
                            Cập nhật
                        </a>
                    </div>
                    <div style="margin-top:6px;font-size:11px;color:#9E9E9E;">
                        Gợi ý combo phù hợp sẽ hiển thị tự động trong phần menu.
                    </div>
                </div>

                <div style="height:10px;"></div>

                <div class="membership-card">
                    <div class="membership-ribbon"></div>
                    <div class="membership-header">
                        <div>
                            <div class="membership-tier">BARE Member</div>
                            <div style="font-size:11px;opacity:0.9;">Tích điểm mỗi đơn, nhận ưu đãi theo cấp bậc.</div>
                        </div>
                        <div class="membership-points">
                            1.000đ = <strong>10 điểm</strong><br>
                            100 điểm = <strong>10.000đ</strong> giảm giá
                        </div>
                    </div>

                    <div class="membership-progress">
                        <div class="progress-bar">
                            <div class="progress-bar-inner"></div>
                        </div>
                        <div class="membership-tiers">
                            <span>Member</span>
                            <span>Silver</span>
                            <span>Gold</span>
                            <span>Platinum</span>
                        </div>
                    </div>

                    <div class="membership-perks">
                        <div>Quyền lợi chính:</div>
                        <ul>
                            <li><span class="perk-dot"></span><span>Tích điểm và dùng như tiền mặt cho đơn sau.</span></li>
                            <li><span class="perk-dot"></span><span>Giảm giá 5–12% theo cấp bậc mỗi đơn.</span></li>
                            <li><span class="perk-dot"></span><span>Combo độc quyền &amp; quà sinh nhật cho member.</span></li>
                        </ul>
                    </div>

                    <div style="margin-top:10px;display:flex;justify-content:space-between;align-items:center;gap:8px;">
                        <a href="{{ route('membership.index') }}" class="btn btn-primary" style="padding-inline:16px;">
                            Đăng ký Membership
                        </a>
                        @auth
                            <a href="{{ route('account.index') }}" class="btn btn-outline" style="padding-inline:12px;font-size:11px;">
                                Xem điểm &amp; lịch sử
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline" style="padding-inline:12px;font-size:11px;">
                                Đăng nhập tài khoản
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        (function () {
            const miniCartCount = document.getElementById('mini-cart-count');
            const miniCartLabel = document.getElementById('mini-cart-label');

            function getCartItems() {
                try {
                    const raw = localStorage.getItem('bare_cart');
                    if (!raw) return [];
                    const parsed = JSON.parse(raw);
                    return Array.isArray(parsed) ? parsed : [];
                } catch (e) {
                    return [];
                }
            }

            function setCartItems(items) {
                try {
                    localStorage.setItem('bare_cart', JSON.stringify(items));
                } catch (e) {}
                updateMiniCartDisplay(items);
            }

            function addToCart(id) {
                const items = getCartItems();
                const existing = items.find(i => i.id === id);
                if (existing) {
                    existing.qty += 1;
                } else {
                    items.push({ id: id, qty: 1 });
                }
                setCartItems(items);
            }

            function updateMiniCartDisplay(items) {
                items = items || getCartItems();
                const count = items.reduce((sum, i) => sum + (i.qty || 0), 0);
                if (miniCartCount) {
                    miniCartCount.textContent = String(count);
                }
                if (miniCartLabel) {
                    miniCartLabel.textContent = 'Món trong giỏ';
                }
            }

            function calculateQuickCalories() {
                const gender = document.getElementById('quick-gender').value;
                const age = parseInt(document.getElementById('quick-age').value || '0', 10);
                const height = parseInt(document.getElementById('quick-height').value || '0', 10);
                const weight = parseFloat(document.getElementById('quick-weight').value || '0');
                const activity = document.getElementById('quick-activity').value;
                const goal = document.getElementById('quick-goal').value;

                if (!age || !height || !weight) return;

                let bmr;
                if (gender === 'male') {
                    bmr = 10 * weight + 6.25 * height - 5 * age + 5;
                } else {
                    bmr = 10 * weight + 6.25 * height - 5 * age - 161;
                }

                const multiplierMap = {
                    sedentary: 1.2,
                    lightly: 1.375,
                    moderately: 1.55,
                    very: 1.725
                };

                const tdee = bmr * (multiplierMap[activity] || 1.2);

                let target;
                if (goal === 'loss') target = tdee - 300;
                else if (goal === 'gain') target = tdee + 250;
                else target = tdee;

                const rounded = Math.round(target / 50) * 50;
                const targetEl = document.getElementById('quick-target-kcal');
                if (targetEl) {
                    targetEl.textContent = '~ ' + rounded.toLocaleString('vi-VN') + ' kcal / ngày';
                }

                const heroCalVal = document.getElementById('hero-cal-value');
                const heroCalBadge = document.getElementById('hero-cal-badge');
                const heroProteinChip = document.getElementById('hero-protein-chip');
                const heroCarbChip = document.getElementById('hero-carb-chip');
                const heroFatChip = document.getElementById('hero-fat-chip');

                if (!heroCalVal || !heroCalBadge) return;

                if (rounded <= 1600) {
                    heroCalVal.textContent = '360 kcal';
                    heroCalBadge.textContent = '360 kcal';
                    if (heroProteinChip) heroProteinChip.textContent = 'Protein 16g';
                    if (heroCarbChip) heroCarbChip.textContent = 'Carb 32g';
                    if (heroFatChip) heroFatChip.textContent = 'Fat 12g';
                } else if (rounded >= 2200) {
                    heroCalVal.textContent = '520 kcal';
                    heroCalBadge.textContent = '520 kcal';
                    if (heroProteinChip) heroProteinChip.textContent = 'Protein 22g';
                    if (heroCarbChip) heroCarbChip.textContent = 'Carb 58g';
                    if (heroFatChip) heroFatChip.textContent = 'Fat 18g';
                } else {
                    heroCalVal.textContent = '430 kcal';
                    heroCalBadge.textContent = '430 kcal';
                    if (heroProteinChip) heroProteinChip.textContent = 'Protein 28g';
                    if (heroCarbChip) heroCarbChip.textContent = 'Carb 42g';
                    if (heroFatChip) heroFatChip.textContent = 'Fat 14g';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                updateMiniCartDisplay();

                const menuContainer = document.getElementById('home-menu-preview');
                if (menuContainer) {
                    menuContainer.addEventListener('click', function (e) {
                        const target = e.target;
                        if (target && target.matches('button[data-id]')) {
                            e.stopPropagation();
                            const id = target.getAttribute('data-id');
                            addToCart(id);
                        }
                    });
                }

                calculateQuickCalories();
            });
        })();
    </script>
@endsection


@extends('layouts.app')

@section('title', 'Tính calories & gợi ý bữa ăn - BARE')

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:8px;">
        Tính nhu cầu calories &amp; gợi ý bữa ăn
    </h1>
    <p style="font-size:13px;color:#616161;margin-bottom:14px;">
        Dựa trên giới tính, tuổi, chiều cao, cân nặng và mức độ hoạt động, BARE sẽ ước tính nhu cầu năng lượng/ngày và gợi ý các bowl phù hợp.
    </p>

    <div style="display:grid;grid-template-columns:minmax(0,1.1fr) minmax(0,1.2fr);gap:24px;">
        <section style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
            <form method="POST" action="{{ route('calories.calculate') }}">
                @csrf
                <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;">
                    <div>
                        <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Giới tính</label>
                        <select name="gender" class="field select">
                            <option value="male" @selected(optional($result)['input']['gender'] ?? old('gender') === 'male')>Nam</option>
                            <option value="female" @selected(optional($result)['input']['gender'] ?? old('gender') === 'female')>Nữ</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Tuổi</label>
                        <input type="number" name="age" value="{{ old('age', optional($result)['input']['age'] ?? 26) }}" class="field">
                    </div>
                    <div>
                        <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Chiều cao (cm)</label>
                        <input type="number" name="height" value="{{ old('height', optional($result)['input']['height'] ?? 168) }}" class="field">
                    </div>
                    <div>
                        <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Cân nặng (kg)</label>
                        <input type="number" step="0.1" name="weight" value="{{ old('weight', optional($result)['input']['weight'] ?? 58) }}" class="field">
                    </div>
                    <div>
                        <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Hoạt động</label>
                        @php $act = optional($result)['input']['activity'] ?? old('activity','sedentary'); @endphp
                        <select name="activity" class="field select">
                            <option value="sedentary" @selected($act==='sedentary')>Ít vận động</option>
                            <option value="lightly" @selected($act==='lightly')>Nhẹ (1–3 buổi/tuần)</option>
                            <option value="moderately" @selected($act==='moderately')>Vừa (3–5 buổi/tuần)</option>
                            <option value="very" @selected($act==='very')>Nhiều (6–7 buổi/tuần)</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Mục tiêu</label>
                        @php $goal = optional($result)['input']['goal'] ?? old('goal','loss'); @endphp
                        <select name="goal" class="field select">
                            <option value="loss" @selected($goal==='loss')>Giảm cân</option>
                            <option value="maintain" @selected($goal==='maintain')>Duy trì</option>
                            <option value="gain" @selected($goal==='gain')>Tăng cân</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top:10px;">
                    Tính toán &amp; gợi ý
                </button>
            </form>

            @if($errors->any())
                <div style="margin-top:8px;font-size:12px;color:#C62828;">
                    Vui lòng kiểm tra lại thông tin nhập.
                </div>
            @endif
        </section>

        <section style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
            @if($result)
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:10px;">
                    <div style="flex:1;min-width:140px;">
                        <div style="font-size:12px;color:#9E9E9E;">BMR (Basal Metabolic Rate)</div>
                        <div style="font-size:18px;font-weight:600;color:#1B5E20;">{{ number_format($result['bmr'],0,',','.') }} kcal</div>
                    </div>
                    <div style="flex:1;min-width:140px;">
                        <div style="font-size:12px;color:#9E9E9E;">TDEE (Total Daily Energy Expenditure)</div>
                        <div style="font-size:18px;font-weight:600;color:#1B5E20;">{{ number_format($result['tdee'],0,',','.') }} kcal</div>
                    </div>
                </div>
                <div style="margin-bottom:10px;">
                    <div style="font-size:12px;color:#9E9E9E;">Calo mục tiêu / ngày</div>
                    <div style="font-size:20px;font-weight:700;color:#C62828;">
                        ~ {{ number_format($result['target_calories'],0,',','.') }} kcal
                    </div>
                </div>
                <p style="font-size:12px;color:#616161;margin-bottom:8px;">
                    Gợi ý: chia thành 2–3 bowl chính và 1–2 bữa phụ. Dưới đây là một số bowl phù hợp với mục tiêu của bạn.
                </p>

                @if($suggested->count())
                    <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;">
                        @foreach($suggested as $p)
                            <article style="border-radius:14px;border:1px solid rgba(158,158,158,0.18);padding:8px 10px;">
                                <div style="font-size:11px;color:#9E9E9E;margin-bottom:2px;">
                                    {{ $p->category?->name ?? 'Bowl' }} · {{ $p->goal_tag ?: 'Cân bằng' }}
                                </div>
                                <div style="font-size:13px;font-weight:600;color:#1B4332;margin-bottom:2px;">
                                    {{ $p->name }}
                                </div>
                                <div style="font-size:11px;color:#616161;margin-bottom:4px;">
                                    {{ $p->calories }} kcal · {{ $p->protein }}g protein
                                </div>
                                <div style="display:flex;justify-content:space-between;align-items:center;">
                                    <span style="font-size:12px;font-weight:600;color:#C62828;">
                                        {{ number_format($p->price,0,',','.') }}đ
                                    </span>
                                    <div style="display:flex;gap:4px;">
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                            <button class="btn btn-outline" style="font-size:11px;padding:4px 8px;">
                                                Thêm vào giỏ
                                            </button>
                                        </form>
                                        <a href="{{ route('menu.show', $p->slug) }}" class="btn btn-primary" style="font-size:11px;padding:4px 8px;">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p style="font-size:12px;color:#9E9E9E;">Chưa có món nào phù hợp trong khoảng calories này. Hãy thử điều chỉnh mục tiêu hoặc tham khảo menu.</p>
                @endif
            @else
                <p style="font-size:13px;color:#616161;">
                    Điền thông tin ở bên trái để tính toán BMR, TDEE và nhận gợi ý bowl phù hợp với bạn.
                </p>
            @endif
        </section>
    </div>
@endsection


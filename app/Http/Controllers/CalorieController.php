<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CalorieController extends Controller
{
    public function index(Request $request)
    {
        $result = null;
        $suggested = collect();

        if ($request->session()->has('calorie_result')) {
            $result = $request->session()->get('calorie_result');
            $target = $result['target_calories'] ?? null;
            if ($target) {
                $suggested = $this->suggestProductsForCalories($target);
            }
        }

        return view('calories.index', [
            'result' => $result,
            'suggested' => $suggested,
        ]);
    }

    public function calculate(Request $request)
    {
        $data = $request->validate([
            'gender' => ['required', 'in:male,female'],
            'age' => ['required', 'integer', 'min:16', 'max:80'],
            'height' => ['required', 'integer', 'min:140', 'max:210'],
            'weight' => ['required', 'numeric', 'min:40', 'max:150'],
            'activity' => ['required', 'in:sedentary,lightly,moderately,very'],
            'goal' => ['required', 'in:loss,maintain,gain'],
        ]);

        if ($data['gender'] === 'male') {
            $bmr = 10 * $data['weight'] + 6.25 * $data['height'] - 5 * $data['age'] + 5;
        } else {
            $bmr = 10 * $data['weight'] + 6.25 * $data['height'] - 5 * $data['age'] - 161;
        }

        $multiplier = match ($data['activity']) {
            'lightly' => 1.375,
            'moderately' => 1.55,
            'very' => 1.725,
            default => 1.2,
        };

        $tdee = $bmr * $multiplier;

        $target = match ($data['goal']) {
            'loss' => $tdee - 300,
            'gain' => $tdee + 250,
            default => $tdee,
        };

        $rounded = round($target / 50) * 50;

        $result = [
            'bmr' => (int)round($bmr),
            'tdee' => (int)round($tdee),
            'target_calories' => (int)$rounded,
            'input' => $data,
        ];

        $request->session()->put('calorie_result', $result);

        return redirect()->route('calories.index');
    }

    protected function suggestProductsForCalories(int $target)
    {
        $lower = max(300, $target * 0.25);
        $upper = $target * 0.5;

        return Product::query()
            ->whereBetween('calories', [(int)$lower, (int)$upper])
            ->where('is_active', true)
            ->orderBy('calories')
            ->limit(8)
            ->get();
    }
}


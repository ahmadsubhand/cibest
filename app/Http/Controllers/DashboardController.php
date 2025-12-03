<?php

namespace App\Http\Controllers;

use App\Models\CibestForm;
use App\Models\CibestQuadrant;
use App\Models\PovertyStandard;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics for the welcome page
     */
    public function index()
    {
        // Get total number of respondents
        $respondentCount = CibestForm::count();

        // Get distribution of quadrants with poverty standard names
        $quadrantDistribution = [];

        // Get all poverty standards to create dynamic quadrants
        $povertyStandards = PovertyStandard::all();

        foreach ($povertyStandards as $standard) {
            // Get quadrant distribution for this poverty standard - before
            $quadrantDataBefore = CibestQuadrant::where('poverty_id', $standard->id)
                ->selectRaw('kuadran_sebelum, COUNT(*) as count')
                ->groupBy('kuadran_sebelum')
                ->orderBy('kuadran_sebelum')
                ->get();

            // Get quadrant distribution for this poverty standard - after
            $quadrantDataAfter = CibestQuadrant::where('poverty_id', $standard->id)
                ->selectRaw('kuadran_setelah, COUNT(*) as count')
                ->groupBy('kuadran_setelah')
                ->orderBy('kuadran_setelah')
                ->get();

            // Create distribution array for this standard with all possible quadrants (1-4)
            $distribution = [
                'id' => $standard->id,
                'name' => $standard->name,
                'before' => [
                    1 => 0, // Kuadran 1
                    2 => 0, // Kuadran 2
                    3 => 0, // Kuadran 3
                    4 => 0, // Kuadran 4
                ],
                'after' => [
                    1 => 0, // Kuadran 1
                    2 => 0, // Kuadran 2
                    3 => 0, // Kuadran 3
                    4 => 0, // Kuadran 4
                ]
            ];

            // Fill the distribution with actual data - before
            foreach ($quadrantDataBefore as $qd) {
                // Ensure we only add to existing quadrants (1-4)
                if (isset($distribution['before'][$qd->kuadran_sebelum])) {
                    $distribution['before'][$qd->kuadran_sebelum] = $qd->count;
                }
            }

            // Fill the distribution with actual data - after
            foreach ($quadrantDataAfter as $qd) {
                // Ensure we only add to existing quadrants (1-4)
                if (isset($distribution['after'][$qd->kuadran_setelah])) {
                    $distribution['after'][$qd->kuadran_setelah] = $qd->count;
                }
            }

            $quadrantDistribution[] = $distribution;
        }

        // Get all poverty standards data
        $povertyStandards = PovertyStandard::orderBy('id')->get();

        // Format the poverty standards data for frontend
        $formattedStandards = $povertyStandards->map(function ($standard) {
            return [
                'id' => $standard->id,
                'name' => $standard->name,
                'index_kesejahteraan_cibest' => $standard->index_kesejahteraan_cibest,
                'besaran_nilai_cibest_model' => $standard->besaran_nilai_cibest_model,
                'nilai_keluarga' => $standard->nilai_keluarga,
                'nilai_per_tahun' => $standard->nilai_per_tahun,
                'log_natural' => $standard->log_natural,
            ];
        });

        // Hardcoded poverty indicators data based on the seed data
        $povertyIndicators = [
            [
                'indicator' => 'Headcount Index (H)',
                'before' => 0.39,
                'after' => 0.33,
                'change' => -0.06
            ],
            [
                'indicator' => 'Income Gap (I)',
                'before' => 0.15,
                'after' => 0.11,
                'change' => -0.04
            ],
            [
                'indicator' => 'Poverty Gap (P1)',
                'before' => 0.08,
                'after' => 0.05,
                'change' => -0.03
            ],
            [
                'indicator' => 'Index Sen (P2)',
                'before' => 0.37,
                'after' => 0.19,
                'change' => -0.18
            ],
            [
                'indicator' => 'Index FGT (P3)',
                'before' => 0.12,
                'after' => 0.05,
                'change' => -0.07
            ]
        ];

        // Hardcoded province data (this would typically come from a database table)
        $provinces = [
            ['name' => 'DK Jawa', 'Q1' => 25, 'Q2' => 27, 'Q3' => 23, 'Q4' => 25, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Jawa Barat', 'Q1' => 22, 'Q2' => 30, 'Q3' => 25, 'Q4' => 23, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Jawa Tengah', 'Q1' => 24, 'Q2' => 35, 'Q3' => 23, 'Q4' => 18, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'DIY', 'Q1' => 25, 'Q2' => 28, 'Q3' => 24, 'Q4' => 23, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Jawa Timur', 'Q1' => 28, 'Q2' => 32, 'Q3' => 22, 'Q4' => 18, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Banten', 'Q1' => 20, 'Q2' => 38, 'Q3' => 20, 'Q4' => 22, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Sumatera Utara', 'Q1' => 30, 'Q2' => 25, 'Q3' => 23, 'Q4' => 22, 'total' => 100, 'dominant' => 'Q1'],
            ['name' => 'Sumatera Barat', 'Q1' => 32, 'Q2' => 22, 'Q3' => 25, 'Q4' => 21, 'total' => 100, 'dominant' => 'Q1'],
            ['name' => 'Riau', 'Q1' => 28, 'Q2' => 26, 'Q3' => 24, 'Q4' => 22, 'total' => 100, 'dominant' => 'Q1'],
            ['name' => 'Jambi', 'Q1' => 26, 'Q2' => 28, 'Q3' => 23, 'Q4' => 23, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Sumatera Selatan', 'Q1' => 24, 'Q2' => 30, 'Q3' => 24, 'Q4' => 22, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Bengkulu', 'Q1' => 25, 'Q2' => 29, 'Q3' => 23, 'Q4' => 23, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Aceh', 'Q1' => 30, 'Q2' => 22, 'Q3' => 25, 'Q4' => 23, 'total' => 100, 'dominant' => 'Q1'],
            ['name' => 'Kepulauan Riau', 'Q1' => 22, 'Q2' => 26, 'Q3' => 24, 'Q4' => 28, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Lampung', 'Q1' => 23, 'Q2' => 27, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Kepulauan Bangka Belitung', 'Q1' => 21, 'Q2' => 26, 'Q3' => 24, 'Q4' => 30, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Jakarta', 'Q1' => 27, 'Q2' => 25, 'Q3' => 23, 'Q4' => 25, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Sulawesi Utara', 'Q1' => 20, 'Q2' => 28, 'Q3' => 24, 'Q4' => 28, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Gorontalo', 'Q1' => 18, 'Q2' => 26, 'Q3' => 24, 'Q4' => 23, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Sulawesi Tengah', 'Q1' => 19, 'Q2' => 25, 'Q3' => 23, 'Q4' => 24, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Sulawesi Barat', 'Q1' => 17, 'Q2' => 24, 'Q3' => 23, 'Q4' => 36, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Sulawesi Selatan', 'Q1' => 21, 'Q2' => 26, 'Q3' => 24, 'Q4' => 29, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Sulawesi Tenggara', 'Q1' => 16, 'Q2' => 28, 'Q3' => 24, 'Q4' => 22, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Kalimantan Barat', 'Q1' => 15, 'Q2' => 26, 'Q3' => 24, 'Q4' => 30, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Kalimantan Tengah', 'Q1' => 14, 'Q2' => 28, 'Q3' => 24, 'Q4' => 24, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Kalimantan Selatan', 'Q1' => 13, 'Q2' => 27, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Kalimantan Timur', 'Q1' => 16, 'Q2' => 25, 'Q3' => 23, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Kalimantan Utara', 'Q1' => 12, 'Q2' => 28, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Papua', 'Q1' => 10, 'Q2' => 28, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Papua Barat', 'Q1' => 11, 'Q2' => 26, 'Q3' => 24, 'Q4' => 28, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Papua Selatan', 'Q1' => 9, 'Q2' => 27, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Papua Tengah', 'Q1' => 8, 'Q2' => 26, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Papua Pegunungan', 'Q1' => 7, 'Q2' => 26, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Maluku', 'Q1' => 12, 'Q2' => 28, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Maluku Utara', 'Q1' => 10, 'Q2' => 26, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
            ['name' => 'Nusa Tenggara Timur', 'Q1' => 11, 'Q2' => 26, 'Q3' => 24, 'Q4' => 28, 'total' => 100, 'dominant' => 'Q4'],
            ['name' => 'Nusa Tenggara Barat', 'Q1' => 13, 'Q2' => 27, 'Q3' => 24, 'Q4' => 26, 'total' => 100, 'dominant' => 'Q2'],
        ];

        return Inertia::render('welcome', [
            'canRegister' => Features::enabled(Features::registration()),
            'respondentCount' => $respondentCount,
            'quadrantDistribution' => $quadrantDistribution,
            'povertyStandards' => $formattedStandards,
            'povertyIndicators' => $povertyIndicators,
            'provinces' => $provinces
        ]);
    }
}
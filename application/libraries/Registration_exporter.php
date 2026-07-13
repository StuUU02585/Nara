<?php

class Registration_exporter
{
    public static function excel(array $rows, array $filters)
    {
        $html = '<!doctype html><html><head><meta charset="utf-8"></head><body>';
        $html .= '<h2>Data Pendaftaran Peserta Sahabat Nara</h2>';
        $html .= '<p>Filter: ' . self::escape(self::filterLabel($filters)) . '</p>';
        $html .= '<table border="1">';
        $html .= '<thead><tr>';
        foreach (self::headers() as $header) {
            $html .= '<th style="background:#e6f6ed;">' . self::escape($header) . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        foreach ($rows as $index => $row) {
            $html .= '<tr>';
            foreach (self::rowValues($row, $index + 1) as $value) {
                $html .= '<td style="mso-number-format:\'\\@\';">' . self::escape($value) . '</td>';
            }
            $html .= '</tr>';
        }

        if (!$rows) {
            $html .= '<tr><td colspan="' . count(self::headers()) . '">Belum ada data pendaftaran.</td></tr>';
        }

        $html .= '</tbody></table></body></html>';
        return $html;
    }

    public static function pdf(array $rows, array $filters)
    {
        $lines = [
            'Data Pendaftaran Peserta Sahabat Nara',
            'Filter: ' . self::filterLabel($filters),
            'Tanggal Export: ' . date('d/m/Y H:i'),
            '',
        ];

        if (!$rows) {
            $lines[] = 'Belum ada data pendaftaran.';
            return self::buildPdf($lines);
        }

        foreach ($rows as $index => $row) {
            $values = self::rowValues($row, $index + 1);
            $lines[] = $values[0] . '. ' . $values[1];
            $lines[] = '   Instansi: ' . $values[4] . ' | Jabatan: ' . $values[5] . ' | Peserta: ' . $values[6];
            $lines[] = '   Kontak: ' . $values[2] . ' | ' . $values[3];
            $lines[] = '   Program: ' . $values[7];
            $lines[] = '   Training: ' . $values[8] . ' | Agenda: ' . $values[9];
            $lines[] = '   Status: ' . $values[10] . ' | Channel: ' . $values[11];
            $lines[] = '   Pesan: ' . $values[12];
            $lines[] = '   Catatan Admin: ' . $values[13];
            $lines[] = '   Tanggal Daftar: ' . $values[14];
            $lines[] = '';
        }

        return self::buildPdf($lines);
    }

    public static function filename($extension)
    {
        return 'data-pendaftaran-' . date('Ymd-His') . '.' . $extension;
    }

    private static function headers()
    {
        return [
            'No',
            'Nama',
            'Email',
            'WhatsApp',
            'Instansi',
            'Jabatan',
            'Jumlah Peserta',
            'Program',
            'Training',
            'Agenda',
            'Status',
            'Channel',
            'Pesan',
            'Catatan Admin',
            'Tanggal Daftar',
        ];
    }

    private static function rowValues(array $row, $number)
    {
        return [
            $number,
            $row['full_name'] ?? '',
            $row['email'] ?? '',
            $row['phone'] ?? '',
            $row['institution'] ?? '',
            $row['position'] ?? '',
            $row['participant_count'] ?? '',
            $row['program_title'] ?? '',
            ($row['training_title'] ?? '') ?: 'Tanpa training spesifik',
            ($row['agenda_title'] ?? '') ?: 'Tanpa agenda khusus',
            str_replace('_', ' ', $row['status'] ?? ''),
            $row['delivery_channel'] ?? '',
            $row['message'] ?? '',
            $row['admin_note'] ?? '',
            $row['created_at'] ?? '',
        ];
    }

    private static function filterLabel(array $filters)
    {
        $parts = [];
        if (!empty($filters['status'])) {
            $parts[] = 'Status ' . str_replace('_', ' ', $filters['status']);
        }
        if (!empty($filters['keyword'])) {
            $parts[] = 'Kata kunci "' . $filters['keyword'] . '"';
        }
        return $parts ? implode(', ', $parts) : 'Semua data';
    }

    private static function buildPdf(array $lines)
    {
        $pages = array_chunk($lines, 42);
        $objects = [];
        $page_ids = [];
        $font_id = 3;

        foreach ($pages as $page_index => $page_lines) {
            $page_id = 4 + ($page_index * 2);
            $content_id = $page_id + 1;
            $page_ids[] = $page_id;
            $objects[$page_id] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 ' . $font_id . ' 0 R >> >> /Contents ' . $content_id . ' 0 R >>';
            $content = self::pageContent($page_lines);
            $objects[$content_id] = '<< /Length ' . strlen($content) . " >>\nstream\n" . $content . "\nendstream";
        }

        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[2] = '<< /Type /Pages /Kids [' . implode(' ', array_map(function ($id) {
            return $id . ' 0 R';
        }, $page_ids)) . '] /Count ' . count($page_ids) . ' >>';
        $objects[$font_id] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';
        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $id => $object) {
            $offsets[$id] = strlen($pdf);
            $pdf .= $id . " 0 obj\n" . $object . "\nendobj\n";
        }

        $xref = strlen($pdf);
        $pdf .= "xref\n0 " . (max(array_keys($objects)) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        for ($i = 1; $i <= max(array_keys($objects)); $i++) {
            $pdf .= sprintf('%010d 00000 n ', $offsets[$i] ?? 0) . "\n";
        }
        $pdf .= "trailer\n<< /Size " . (max(array_keys($objects)) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xref . "\n%%EOF";

        return $pdf;
    }

    private static function pageContent(array $lines)
    {
        $content = "BT\n/F1 10 Tf\n50 800 Td\n14 TL\n";
        foreach ($lines as $line) {
            $content .= '(' . self::pdfText(self::limit($line, 105)) . ") Tj\nT*\n";
        }
        return $content . "ET";
    }

    private static function limit($value, $length)
    {
        $value = preg_replace('/\s+/', ' ', (string) $value);
        return strlen($value) > $length ? substr($value, 0, $length - 3) . '...' : $value;
    }

    private static function pdfText($value)
    {
        $value = str_replace(["\r", "\n"], ' ', (string) $value);
        if (function_exists('iconv')) {
            $converted = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $value);
            if ($converted !== false) {
                $value = $converted;
            }
        }
        $value = preg_replace('/[^\x20-\x7E]/', '?', $value);
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $value);
    }

    private static function escape($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

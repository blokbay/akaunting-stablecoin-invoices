<?php

return [

    'name' => 'Blokbay',
    'description' => 'Pelanggan Anda membayar faktur dengan USDC atau USDT di halaman pembayaran Blokbay, dan pembayaran tercatat sendiri di faktur.',
    'method_name' => 'USDC / USDT (Blokbay)',
    'portal_text' => 'Bayar faktur ini dengan USDC atau USDT dari wallet Anda di halaman pembayaran Blokbay yang aman.',
    'pay_title' => 'Bayar faktur ini dengan USDC atau USDT',
    'pay_button' => 'Bayar dengan USDC/USDT',
    'create_button' => 'Bayar dengan Blokbay',
    'email_line' => 'Anda dapat membayar faktur ini dengan USDC atau USDT:',
    'taxes' => 'Pajak',
    'balance_line' => 'Sisa tagihan faktur :number',

    'settings' => [
        'title' => 'Pengaturan',
        'api' => 'Akun Blokbay',
        'api_description' => 'Kunci ada di halaman Pembayaran dari situs Anda di dasbor Blokbay.',
        'api_url' => 'URL API',
        'secret_key' => 'Kunci rahasia (sk_live_...)',
        'webhook_secret' => 'Rahasia tanda tangan webhook (whsec_...)',
        'saved' => 'Tersimpan (:hint): kosongkan untuk mempertahankan',
        'account' => 'Rekening bank untuk pembayaran',
        'webhook' => 'Webhook',
        'webhook_description' => 'Blokbay memberi tahu Akaunting saat faktur dibayar atau dibatalkan.',
        'webhook_url' => 'URL webhook untuk disalin ke dasbor Blokbay',
        'webhook_events' => 'Peristiwa: invoice.paid, invoice.voided. Setiap peristiwa ditandatangani dan diperiksa dengan API.',
        'how' => 'Buka faktur yang sudah dikirim dan klik Bayar dengan Blokbay: tautan pembayaran muncul di faktur, PDF, halaman pelanggan, dan email faktur. Saat pelanggan membayar, pembayaran ditambahkan ke faktur di rekening yang dipilih di sini.',
    ],

    'messages' => [
        'configure' => 'Tambahkan kunci Blokbay Anda untuk menerima USDC dan USDT pada faktur ini.',
        'create_help' => 'Buat tautan pembayaran: pelanggan membayar dengan USDC atau USDT dan pembayaran tercatat sendiri di sini.',
        'created' => 'Tautan pembayaran Blokbay dibuat untuk faktur :number.',
        'link_ready' => 'Tautan pembayaran faktur Blokbay :number, juga di PDF, halaman pelanggan, dan email faktur.',
        'paid' => 'Dibayar dengan Blokbay (faktur :number).',
        'voided' => 'Tautan pembayaran sebelumnya dibatalkan.',
    ],

    'errors' => [
        'not_configured' => 'Blokbay: tambahkan dulu kunci rahasia di pengaturan.',
        'unreachable' => 'Blokbay: API tidak dapat dijangkau, coba lagi dalam beberapa menit.',
        'api' => 'Permintaan ditolak.',
        'unexpected' => 'Blokbay: jawaban API tidak terduga.',
        'currency' => 'Faktur Blokbay menerima :accepted, bukan :currency.',
        'email' => 'Tambahkan alamat email pelanggan: Blokbay memerlukannya untuk tautan pembayaran.',
        'not_payable' => 'Hanya faktur penjualan yang sudah dikirim dan belum dibayar yang bisa dibayar dengan Blokbay.',
        'portal' => 'Metode pembayaran ini sedang tidak tersedia. Silakan coba lagi nanti.',
        'api_url' => 'Masukkan URL API dengan https, misalnya https://blokbay.com.',
        'secret_key' => 'Kunci rahasia diawali sk_live_.',
        'webhook_secret' => 'Rahasia webhook diawali whsec_.',
        'account' => 'Pilih rekening bank.',
    ],

];

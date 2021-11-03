<?php

return [
    // views/courses/*
    'materi' => 'Materi',

    'gratis' => 'Gratis',
    'premium' => 'Premium',
    'premium.star' => '<i class="fas fa-star mr-1"></i>Premium<i class="fas fa-star ml-1"></i>',

    'kategori' => 'Kategori',
    'membership' => 'Membership',

    'perbarui' => 'Perbarui',
    'simpan' => 'Simpan',
    'submit' => 'Submit',
    'hapus' => 'Hapus',
    'batal' => 'Batal',

    // views/courses/index
    'index.baru' => 'Kursus Baru',

    // views/courses/templates/header
    'header.perbarui' => 'Perbarui',

    // views/courses/templates/navbar
    'navbar.bab' => 'Bab',
    'navbar.deskripsi' => 'Deskripsi',
    'navbar.materi' => 'Materi',
    'navbar.forum' => 'Forum',
    'navbar.ulasan' => 'Ulasan',

    // views/courses/templates/sidebar
    'sidebar.daftar' => 'Daftar Kursus',
    'sidebar.membership.buy' => 'Beli Membership',
    'sidebar.favorite.tambah' => 'Tambah Favorit',
    'sidebar.favorite.hapus' => 'Hapus Favorit',
    'sidebar.staff' => 'Anda adalah staff pada '.env('APP_NAME', 'Laravel E-Learning').'. Anda dapat memperbarui dan menghapus kursus ini.',
    'sidebar.author' => 'Anda adalah pembuat kursus ini. Anda dapat memperbarui dan menghapus kursus ini.',
    'sidebar.member.unregister' => 'Anda belum dapat mempelajari kursus ini. Daftar sekarang untuk dapat mengikuti pembelajaran.',
    'sidebar.member.registered' => 'Anda sudah terdaftar pada kursus ini.',
    'sidebar.member.unpremium' => 'Anda belum dapat mempelajari kursus ini. Beli membership sekarang untuk dapat mengikuti pembelajaran.',

    // views/courses/create && edit
    'form.judul' => 'Judul Kursus',
    'form.image' => 'Gambar Sampul',
    'form.upload.image' => 'Unggah Gambar',
    'form.desc' => 'Deskripsi Kursus',
    'form.delete.title' => 'Hapus Kursus',
    'form.delete.button' => 'Hapus Kursus',
    'form.delete.confirm' => 'Apakah anda yakin untuk menghapus kursus ini?',

    // views/courses/bab/create && edit
    'bab.urutan' => 'Urutan Bab',
    'bab.judul' => 'Judul Bab',
    'bab.hapus' => 'Hapus Bab',
    'bab.hapus.konfirmasi' => 'Apakah anda yakin untuk menghapus bab ini?',
    'bab.materi.baru' => 'Materi Baru',

    // views/courses/materi/create && edit
    'materi.urutan' => 'Urutan Materi',
    'materi.judul' => 'Judul Materi',
    'materi.isi' => 'Isi Materi',
    'materi.unggah.file' => 'Unggah Berkas',
    'materi.berkas' => 'Berkas',
    'materi.bab' => 'Bab',
    'materi.hapus' => 'Hapus Materi',
    'materi.hapus.konfirmasi' => 'Apakah anda yakin untuk menghapus kursus ini?',

    // views/courses/bab/show
    'materi.diskusikan' => 'Diskusikan',
    'materi.laporkan' => 'Laporkan',

    // views/courses/forums/index
    'forum.new' => 'Forum Baru',
    'forum.nothing' => 'Kursus ini belum memiliki forum.',

    // views/courses/forums/create
    'forum.form.title' => 'Judul Forum',
    'forum.form.content' => 'Isi Forum',

    // views/courses/forums/edit
    'forum.form.edit' => 'Perbarui Forum',
    'forum.form.hapus' => 'Hapus Forum',
    'forum.form.hapus.confirm' => 'Apakah anda yakin untuk menghapus forum ini?',

    // views/courses/forums/show
    'forum.show.balas' => 'Balas',
    'forum.show.reply.content' => 'Isi Balasan',
    'forum.show.reply.button' => 'Balas',

    // views/courses/forums/replies/edit
    'forum.reply.edit' => 'Perbarui Balasan',
    'forum.reply.hapus' => 'Hapus Balasan',
    'forum.reply.hapus.confirm' => 'Apakah anda yakin untuk menghapus balasan ini?',

    // views/courses/reviews/index
    'review.anonim' => 'Anonim',
    'review.all' => 'Semua Ulasan',
    'review.nothing' => 'Kursus ini belum memiliki ulasan.',

    // views/courses/reviews/rating
    'review.hidename' => 'Sembunyikan nama saya',
    'review.submit' => 'Beri Ulasan',
];

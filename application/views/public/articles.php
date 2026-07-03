<section class="page-hero article-hero">
    <p class="eyebrow">Artikel & Insights</p>
    <h1>Insight HR, leadership, dan dunia kerja Indonesia</h1>
    <p>Artikel terhubung dengan ProleadIndonesia.com sebagai media partner.</p>
</section>

<section class="section article-list-section">
    <div class="grid cards" id="prolead-article-container">
        <p style="grid-column: 1/-1; text-align: center; color: #666;" id="loading-text">Sedang memuat artikel terbaru...</p>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('prolead-article-container');
    const loadingText = document.getElementById('loading-text');
    
    // FIXED CACHE: Ditambahkan token dinamis timestamp agar browser tidak mengandalkan cache lama
    // Kuota per_page tetap dikunci di angka 20 agar daftar artikel lo selalu fresh dan rapi.
    const apiUrl = 'https://proleadindonesia.com/wp-json/wp/v2/posts?_embed&per_page=20&_cb=' + new Date().getTime();

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) throw new Error('Gagal mengambil data dari API');
            return response.json();
        })
        .then(posts => {
            // Hapus teks loading
            if(loadingText) loadingText.remove();

            if (posts.length === 0) {
                container.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #666;">Tidak ada artikel terbaru.</p>';
                return;
            }

            let htmlContent = '';

            posts.forEach(post => {
                // 1. Ambil Judul
                const title = post.title && post.title.rendered ? post.title.rendered : 'No Title';
                
                // 2. Ambil Link Berita asli
                const link = post.link ? post.link : '#';
                
                // 3. Ambil Ringkasan Teks & bersihkan dari Tag HTML bawaan WP
                let summary = '';
                if (post.excerpt && post.excerpt.rendered) {
                    summary = post.excerpt.rendered.replace(/<\/?[^>]+(>|$)/g, ""); // Trik regex hapus tag HTML
                    if (summary.length > 120) {
                        summary = summary.substring(0, 120) + '...';
                    }
                }

                // Masukkan ke struktur card bawaan CSS lo bro
                htmlContent += `
                    <article class="card">
                        <h3>${title}</h3>
                        <p>${summary}</p>
                        <a href="${link}" target="_blank" rel="noopener">Baca di ProleadIndonesia</a>
                    </article>
                `;
            });

            container.innerHTML = htmlContent;
        })
        .catch(error => {
            console.error(error);
            if(loadingText) {
                loadingText.innerText = 'Terjadi gangguan sementara. Silakan coba kembali beberapa saat lagi.';
            }
        });
});
</script>
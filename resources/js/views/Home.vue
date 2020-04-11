<template>
  <div>
    <div id="contact" class="flex-row-sp container">
      <div>
        <img
          src="../../assets/svg/promo.svg"
          style="height:30px; margin-top:-12px; margin-right: 5px;"
        />
        <p>Gratis Ebook 9 Cara Cerdas Menggunakan Domain [x]</p>
      </div>

      <div>
        <div>
          <v-icon class="mh-5" x-small>mdi-phone</v-icon>0274-5305505
        </div>
        <div>
          <v-icon class="mh-5" mr-5 x-small>mdi-message</v-icon>Live Chat
        </div>
        <div>
          <v-icon class="mh-5" mr-5 x-small>mdi-account</v-icon>Member Area
        </div>
      </div>
    </div>

    <div id="menus" class="flex-row-sp container border-bottom">
      <div class="flex-row" style="relative">
        <img src="../../assets/images/logo.png" style="height:80px; position: absolute; top:40px" />
      </div>
      <div class="flex-row">
        <div v-for="(menu, index) in menus" :key="index">
          <button class="btn-menu">{{menu.title}}</button>
        </div>
      </div>
    </div>

    <div class="topnav">
      <img src="../../assets/images/logo.png" class="active" />
      <div :class="navbarOpen ? 'open' : 'close'">
        <a :href="'#'+menu.to" v-for="(menu, index) in menus" :key="index">{{menu.title}}</a>
      </div>
      <a href="#" class="icon" v-on:click="navbar">
        <v-icon medium>mdi-menu</v-icon>
      </a>
    </div>

    <div id="banner" class="flex-row container flex-center flex-wrap">
      <div class="flex" style="max-width: 600px; padding: 0px 12px 0px 12px;">
        <p class="font-26 mv-5 font-bold">PHP Hosting</p>
        <p class="mv-5">Cepat, handal, penuh dengan modul PHP yang Anda Butuhkan</p>
        <div>
          <div v-for="(benefit, index) in benefits" :key="index" class="font-12 mv-5">
            <v-icon class="mr-5" mr-5 small style="color:#2ecc71">mdi-check-circle</v-icon>
            {{benefit}}
          </div>
        </div>
      </div>
      <div class="flex image-container">
        <img src="../../assets/svg/banner.svg" class="banner-image" />
      </div>
    </div>

    <div id="feature" class="flex-row container flex-center mv-20 flex-wrap">
      <div class="flex-column mh-20 mv-20">
        <div class="image-container flex center image-center">
          <img src="../../assets/images/zendguard.png" style="height:auto; width: 150px;" />
        </div>
        <p class="font-12" style="text-align: center">PHP Zend Guard Loader</p>
      </div>
      <div class="flex-column mh-20 mv-20">
        <div class="image-container flex image-center">
          <img src="../../assets/images/composer.png" style="height:auto; width: 150px" />
        </div>
        <p class="font-12" style="text-align: center">PHP Composer</p>
      </div>
      <div class="flex-column mh-20 mv-20">
        <div class="image-container flex image-center">
          <img src="../../assets/images/ioncube.png" style="height:auto; width: 150px" />
        </div>
        <p class="font-12" style="text-align: center">PHP IonCube Loader</p>
      </div>
    </div>

    <div class="flex-column flex-center container image-container">
      <p class="font-22 mv-5 font-bold">Paket Hosting Singapura yang tepat</p>
      <p>Diskon 40% + domain dan SSL Gratis Untuk Anda</p>
    </div>

    <div class="flex-row flex-center container flex-wrap font-12" id="promo">
      <div
        class="flex-column image-container mv-5 ph-5"
        :class="promo.best_price ? 'border-blue' : 'border'"
        style="position: relative"
        v-for="(promo, index) in promos"
        :key="index"
      >
        <div v-if="promo.best_price" class="ribbon-wrapper-green">
          <div class="ribbon-green">BEST SELLER</div>
        </div>
        <div
          class="promo-table font-bold font-20 p-10"
          :class="promo.best_price ? 'best' : ''"
        >{{promo.title}}</div>
        <div class="p-10" :class="promo.best_price ? 'best' : ''">Rp {{promo.price}}</div>
        <div class="p-10" :class="promo.best_price ? 'best' : ''">
          Rp
          <span class="font-bold font-26">{{String (promo.price).split('.')[0]}}</span>
          <span class="font-bold">.{{String (promo.price).split('.')[1]}}</span>
          / {{promo.time}}
        </div>
        <div class="p-10" :class="promo.best_price ? 'best-2' : ''">
          <span class="font-bold">{{promo.users}}</span> Pengguna terdaftar
        </div>
        <div class="p-10"></div>
        <div class="p-10">
          <button
            :class="promo.best_price ? 'btn-blue-rounded': 'btn-white-outline-rounded'"
            class="font-bold font-12 left"
          >Pilih Hosting Anda</button>
        </div>
      </div>
    </div>

    <div class="flex-column flex-center container image-container">
      <p class="font-22 mv-5">Powerful dengan limit PHP yang Lebih Besar</p>
      <div id="feature" class="flex-row container flex-center mv-20 flex-wrap">
        <div class="flex-column mh-20">
          <div class="border feature-php flex-row">
            <div class="flex left">
              <v-icon small style="color:#2ecc71">mdi-check-circle</v-icon>
            </div>
            <div class="flex-2 font-12">max excecution time 300s</div>
          </div>
          <div class="border feature-php flex-row">
            <div class="flex left">
              <v-icon small style="color:#2ecc71">mdi-check-circle</v-icon>
            </div>
            <div class="flex-2 font-12">max excecution time 300s</div>
          </div>
          <div class="border feature-php flex-row">
            <div class="flex left">
              <v-icon small style="color:#2ecc71">mdi-check-circle</v-icon>
            </div>
            <div class="flex-2 font-12">php memory limit 1024 MB</div>
          </div>
        </div>
        <div class="flex-column mh-20">
          <div class="border feature-php flex-row">
            <div class="flex left">
              <v-icon small style="color:#2ecc71">mdi-check-circle</v-icon>
            </div>
            <div class="flex-2 font-12">post max size 128 MB</div>
          </div>
          <div class="border feature-php flex-row">
            <div class="flex left">
              <v-icon small style="color:#2ecc71">mdi-check-circle</v-icon>
            </div>
            <div class="flex-2 font-12">upload max filesize 128 MB</div>
          </div>
          <div class="border feature-php flex-row">
            <div class="flex left">
              <v-icon small style="color:#2ecc71">mdi-check-circle</v-icon>
            </div>
            <div class="flex-2 font-12">max input vars 2500</div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex-column container">
      <div class="flex-row container flex-center">
        <div class="slice-border" />
      </div>
    </div>

    <div class="flex-column flex-center container image-container">
      <p class="font-22 mv-20">Semua Paket Hosting Sudah Termasuk</p>
      <div class="flex-row flex-wrap flex-center">
        <div v-for="(packet, index) in packets" :key="index" class="flex-column mh-20 packet mv-20">
          <img :src="packet.image" />
          <p class="font-bold">{{packet.title}}</p>
          <p class="font-12">{{packet.description}}</p>
        </div>
      </div>
    </div>

    <div class="flex-column container">
      <div class="flex-row container flex-center">
        <div class="slice-border" />
      </div>
    </div>

    <div class="flex-column flex-center container image-container">
      <p class="font-22 mv-20">Mendukung Penuh Framework Laravel</p>
    </div>

    <div class="flex-row-sp container flex-center flex-wrap border-bottom">
      <div class="flex" style="max-width: 600px">
        <p
          class="mb-20"
          style="max-width: 600px"
        >Tak perlu menggunakan dedicated server ataupun VPS yang mahal. Layanan PHP hosting murah kami mendukung penuh framework favorit Anda</p>
        <div class="mb-20">
          <div class="font-12 mv-5">
            <v-icon class="mr-5" mr-5 small style="color:#2ecc71">mdi-check-circle</v-icon>Install laravel dengan
            <span class="font-bold">1 klik</span> Softaculous Installer.
          </div>
          <div class="font-12 mv-5">
            <v-icon class="mr-5" mr-5 small style="color:#2ecc71">mdi-check-circle</v-icon>Mendukung Eksitensi
            <span class="font-bold">PHP MCrypt, phar, mbstring,</span> dan
            <span class="font-bold">fileinfo</span>
          </div>
          <div class="font-12 mv-5">
            <v-icon class="mr-5" mr-5 small style="color:#2ecc71">mdi-check-circle</v-icon>Tersedia
            <span class="font-bold">Composer</span> dan
            <span class="font-bold">SSH</span> untuk menginstal packages Anda.
          </div>
        </div>
        <p class="font-10 mb-20">Nb. Composer dan SSH hanya tersedia pada paket Personal dan Bisnis</p>
        <div>
          <button class="font-bold font-12 btn-blue-rounded left">Pilih Hosting Anda</button>
        </div>
      </div>
      <div class="flex image-container">
        <img src="../../assets/svg/laravel.svg" style="width:350px" />
      </div>
    </div>

    <div class="flex-column flex-center container image-container">
      <p class="font-22 mv-20">Modul Lengkap untuk Menjalankan Aplikasi PHP Anda</p>
      <div class="flex-row flex-wrap flex-center mb-20">
        <p v-for="(module, index) in modules" :key="index" class="module left font-12">{{module}}</p>
      </div>
      <div>
        <button class="font-bold font-12 btn-white-outline-rounded">Selengkapnya</button>
      </div>
    </div>

    <div class="flex-row-sp container flex-center flex-wrap">
      <div class="flex" style="max-width: 600px">
        <p class="font-22 mv-20">Linux Hosting yang Stabil dengan Teknologi LVE</p>
        <p class="font-12 mb-20">
          SuperMicro
          <span class="font-bold">Intel Xeion 24-Cores</span> server dengan RAM
          <span class="font-bold">128 GB</span> dan teknologi
          <span class="font-bold">LVE CloudLinux</span> untuk stabilitas server Anda. Dilengkapi dengan
          <span class="font-bold">SSD</span> untuk kecepatan
          <span class="font-bold">MySQL</span> dan caching Apache load balancer berbasis LiteSpeed Technologies
          <span
            class="font-bold"
          >CageFS</span> security.
          <span class="font-bold">Raid-10</span> protection dan auto backup untuk keamanan website PHP Anda
        </p>
        <div>
          <button class="font-bold font-12 btn-blue-rounded left">Pilih Hosting Anda</button>
        </div>
      </div>
      <div class="flex image-container">
        <img src="../../assets/images/image_support.png" style="width:400px" />
      </div>
    </div>

    <div id="likes">
      <div class="container flex-row">
        <p class="font-12 flex">Bagikan jika anda menyukai Halaman ini.</p>
        <p class="flex font-12">Bagikan jika anda menyukai Halaman ini.</p>
      </div>
    </div>

    <div id="help">
      <div class="container flex-row flex-wrap">
        <p class="font-22 flex">
          Perlu
          <span class="font-bold">BANTUAN?</span> Hubungi kami :
          <span class="font-bold">0274-5305505</span>.
        </p>
        <div class="flex image-center">
          <button class="font-bold font-12 btn-blue-outline-rounded flex-row">
            <v-icon class="mh-5" small color="#ffffff">mdi-message</v-icon>
            <span>Live Chat</span>
          </button>
        </div>
      </div>
    </div>

    <div id="others">
      <div class="flex-row flex-wrap container">
        <div class="flex-column others">
          <p class="font-bold font-12 mb-20">HUBUNGI KAMI</p>
          <div class="mb-20 flex-column">
            <button class="font-10 left">0274-5305505</button>
            <button class="font-10 left">Senin-Minggu</button>
            <button class="font-10 left">24 Jam Non Stop</button>
          </div>
          <p>Jl. Selokan Mataram Monjali, Karangjati MT/ I/304 Sinduadi, Mlati, Sleman Yogyakarta 55284</p>
        </div>
        <div class="flex-column others">
          <p class="font-bold font-12 mb-20">LAYANAN</p>
          <div class="mb-20 flex-column">
            <button class="font-10 left">Domain</button>
            <button class="font-10 left">Shared Hosting</button>
            <button class="font-10 left">Cloud VPS Hosting</button>
            <button class="font-10 left">Managed VPS Hosting</button>
            <button class="font-10 left">Web Builder</button>
            <button class="font-10 left">Keamanan SSL / HTTPS</button>
            <button class="font-10 left">Jasa Pembuatan Website</button>
            <button class="font-10 left">Program Affiliasi</button>
          </div>
        </div>
        <div class="flex-column others">
          <p class="font-bold font-12 mb-20">SERVICE HOSTING</p>
          <div class="mb-20 flex-column">
            <button class="font-10 left">Hosting Murah</button>
            <button class="font-10 left">Hosting Indonesia</button>
            <button class="font-10 left">Hosting Singapura SG</button>
            <button class="font-10 left">Hosting PHP</button>
            <button class="font-10 left">Hosting PHP</button>
            <button class="font-10 left">Hosting Laravel</button>
          </div>
        </div>
        <div class="flex-column others">
          <p class="font-bold font-12 mb-20">TUTORIAL</p>
          <div class="mb-20 flex-column">
            <button class="font-10 left">Knowledgebase</button>
            <button class="font-10 left">Blog</button>
            <button class="font-10 left">Cara Pembayaran</button>
          </div>
        </div>
        <div class="flex-column others">
          <p class="font-bold font-12 mb-20">TENTANG KAMI</p>
          <div class="mb-20 flex-column">
            <button class="font-10 left">Tim NiagaHoster</button>
            <button class="font-10 left">Karir</button>
            <button class="font-10 left">Events</button>
            <button class="font-10 left">Penawaran dan Promo Spesial</button>
            <button class="font-10 left">Kontak Kami</button>
          </div>
        </div>
        <div class="flex-column others">
          <p class="font-bold font-12 mb-20">KENAPA PILIH NIAGAHOSTER</p>
          <div class="mb-20 flex-column">
            <button class="font-10 left">Support Terbaik</button>
            <button class="font-10 left">Garansi Harga termurah</button>
            <button class="font-10 left">Domain Gratis Selamanya</button>
            <button class="font-10 left">Data Center Hosting Terbaik</button>
            <button class="font-10 left">Review Pelanggan</button>
          </div>
        </div>
        <div class="flex-column others-2">
          <p class="font-bold font-12 mb-20">REVIEW PELANGGAN</p>
          <div class="flex-row">
            <div class="email flex-row">
              <input class="input-email" />
              <button class="btn-blue-rounded">Berlangganan</button>
            </div>
            <div class="flex-row image-center">
              <button class="btn-social-media">
                <v-icon color="#ffffff" medium>mdi-facebook</v-icon>
              </button>

              <button class="btn-social-media">
                <v-icon color="#ffffff" medium>mdi-twitter</v-icon>
              </button>

              <button class="btn-social-media">
                <v-icon color="#ffffff" medium>mdi-google</v-icon>
              </button>
            </div>
          </div>
          <div class="flex-row mv-5">
            <p
              class="font-info font-10"
            >Dapatkan promo dan konten menarik dari penyedia hosting terbaik Anda</p>
          </div>
        </div>
      </div>

      <div class="flex-column flex-wrap container">
        <p class="font-bold font-12 mb-20">PEMBAYARAN</p>
        <p
          class="font-info font-10"
        >Aktivasi intan dengan e-Payment. Hosting dan domain langsung aktif!</p>
        <div class="border-bottom-2 mv-20" />

        <div class="flex-row-sp flex-wrap">
          <div class="flex-column">
            <p
              class="font-info font-10 mv-5"
            >Copyright &copy;2016 NiagaHoster | Hosting Powered by PHP7, CloudLinux, CloudFlare, BitNinja and DC Biznet Technovillage Jakarta</p>
            <p
              class="font-info font-10 mv-5"
            >Cloud VPS murah powered by WEbuzo softaculous, intel SSD and cloud computing technology</p>
          </div>
          <div>
            <button class="font-10">Syarat dan Ketentuan</button> |
            <button class="font-10">Kebijakan Privasi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" src="./home.ts"></script>

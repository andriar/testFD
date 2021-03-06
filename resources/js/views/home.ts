import Vue from 'vue';
import { Component } from 'vue-property-decorator';
import { PromoModule } from '../store/modules/promo';

@Component({
	name: 'Home',
})
export default class Home extends Vue {
	get loading() {
		return PromoModule.loading;
	}

	get loadingAction() {
		return PromoModule.loadingAction;
	}

	get promos() {
		return PromoModule.promos;
	}

	get promo() {
		return PromoModule.promo;
	}

	menus: any[] = [
		{
			title: 'Hosting',
			to: 'hosting',
		},
		{
			title: 'Domain',
			to: 'domain',
		},
		{
			title: 'Server',
			to: 'server',
		},
		{
			title: 'Website',
			to: 'website',
		},
		{
			title: 'Afiliasi',
			to: 'afiliasi',
		},
		{
			title: 'Promo',
			to: 'promos',
		},
		{
			title: 'Pembayaran',
			to: 'pembayaran',
		},
		{
			title: 'Review',
			to: 'review',
		},
		{
			title: 'Kontak',
			to: 'kontak',
		},
		{
			title: 'Blog',
			to: 'blog',
		},
	];
	benefits: any[] = [
		'Solusi PHP untuk solusi performa yang lebih baik',
		'Konsumsi Memory yang lebih rendah',
		'Support PHP 5.3, PHP 5.4, PHP 5.5, PHP 5.6, PHP 7',
		'Fitur Enkripsi IonCube dan Zend Guard Loaders',
	];

	navbarOpen: boolean = false;

	modules: any[] = [
		'icePHP',
		'http',
		'nd_pdo_mysql',
		'stats',
		'apc',
		'huffman',
		'oauth',
		'stem',
		'apcu',
		'idn',
		'oci8',
		'stomp',
		'apm',
		'igbinary',
		'odbc',
		'suhosin',
		'bcmath',
		'imap',
		'pdf',
		'sysvmsg',
		'bcompiler',
		'included',
		'pdo',
		'sysvsem',
		'big_int',
		'inotify',
		'pdo_dblib',
		'sysvshm',
		'bitset',
		'interbase',
		'pdo_firebird',
		'tidy',
		'bloomy',
		'intl',
		'pdo_mysql',
		'timezonedb',
		'bz2_filter',
		'ioncube_loader',
		'pdo_odbc',
		'trader',
		'clamav',
		'ioncube_laoder_4',
		'pdo_pgsql',
		'translit',
		'coin_acceptor',
		'jsmin',
		'pdo_sqlite',
		'uploadprogress',
		'crack',
		'json',
		'pgsql',
		'uri_template',
		'dba',
		'idap',
		'phalcon',
		'uuid',
	];

	packets: any[] = [
		{
			title: 'PHP Semua Versi',
			description: 'Pilih mulai dari versi PHP 5.3 s/d PHP 7. Ubaj sesuka Anda!',
			image: require('../../assets/svg/phpversion.svg'),
		},
		{
			title: 'MySQL Versi 5.6',
			description: 'Nikmati MySQL versi terbaru, tercepat dan kaya akan fitur',
			image: require('../../assets/svg/hosting_mysql.svg'),
		},
		{
			title: 'Panel Hosting cPanel',
			description: 'Kelola Website dengan panel canggil yang familiar di hati anda',
			image: require('../../assets/svg/cpanel.svg'),
		},
		{
			title: 'Garansi Uptime 99.9%',
			description: 'Data center yang mendukung kelangsungan website Anda 24/7',
			image: require('../../assets/svg/uptime.svg'),
		},
		{
			title: 'Database InnoDB unlimited',
			description: 'Jumlah dan ukuran database yang tumbuh sesuai kebutuhan Anda',
			image: require('../../assets/svg/innoDB.svg'),
		},
		{
			title: 'Wildcard Remote MySQL',
			description: 'Mendukung s/d 25 max_user_connections dan 100 max-connections',
			image: require('../../assets/svg/mysql.svg'),
		},
	];

	mounted() {
		this.fetchData();
	}

	whoBestSeller(best: boolean) {
		return best ? 'best flex-column border image-container  p-5' : 'flex-column border image-container  p-5';
	}

	navbar() {
		this.navbarOpen = !this.navbarOpen;
	}

	async fetchData() {
		const params = {
			join: 'features',
			sort: {
				key: 'real_price',
				value: 'ASC',
			},
		};
		await PromoModule.fetchAllPromo(params);
	}
}

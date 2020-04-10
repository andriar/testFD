import Vue from 'vue';
import { Component } from 'vue-property-decorator';
@Component({
	name: 'Home',
})
export default class Home extends Vue {
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
			to: 'promo',
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
	promos: any[] = [
		{
			title: 'hohoho',
			price: 19000,
			discount: 0,
			users: 1021,
			best_price: false,
			feature: {
				resource_power: '0.5',
				disk_space: '500MB',
				bandwith: 'unlimited',
				databases: 'unlimited',
				domain: '1',
				backup: 'instant',
			},
		},
		{
			title: 'hohoho',
			price: 19000,
			discount: 0,
			users: 1021,
			best_price: false,
			feature: {
				resource_power: '0.5',
				disk_space: '500MB',
				bandwith: 'unlimited',
				databases: 'unlimited',
				domain: '1',
				backup: 'instant',
			},
		},
		{
			title: 'hohoho',
			price: 19000,
			discount: 0,
			users: 1021,
			best_price: true,
			feature: {
				resource_power: '0.5',
				disk_space: '500MB',
				bandwith: 'unlimited',
				databases: 'unlimited',
				domain: '1',
				backup: 'instant',
			},
		},
		{
			title: 'hohoho',
			price: 19000,
			discount: 0,
			users: 1021,
			best_price: false,
			feature: {
				resource_power: '0.5',
				disk_space: '500MB',
				bandwith: 'unlimited',
				databases: 'unlimited',
				domain: '1',
				backup: 'instant',
			},
		},
	];

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

	whoBestSeller(best: boolean) {
		return best ? 'best flex-column border image-container' : 'flex-column border image-container';
	}
}

<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\OAuthProvider
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_user_id
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereUserId($value)
 * @mixin \Eloquent
 */
	class OAuthProvider extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\Kas
 *
 * @property int $id
 * @property string $nama
 * @property string $kode
 * @property string $jumlah
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Kas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kas newQuery()
 * @method static \Illuminate\Database\Query\Builder|Kas onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Kas withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Kas withoutTrashed()
 * @mixin \Eloquent
 */
	class Kas extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\LogKas
 *
 * @property int $id
 * @property int $kas_id
 * @property string $kode
 * @property string $jumlah
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payer_type
 * @property int|null $payer_id
 * @property string|null $keterangan
 * @property-read \App\Models\Tenongan\Kas $kas
 * @property-read Model|\Eloquent $payer
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas newQuery()
 * @method static \Illuminate\Database\Query\Builder|LogKas onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereKasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas wherePayerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LogKas withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LogKas withoutTrashed()
 * @mixin \Eloquent
 */
	class LogKas extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\LogSaldo
 *
 * @property int $id
 * @property string $kode
 * @property int $saldo_id
 * @property string $jumlah
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenongan\Saldo $saldo
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo newQuery()
 * @method static \Illuminate\Database\Query\Builder|LogSaldo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereSaldoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LogSaldo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LogSaldo withoutTrashed()
 * @mixin \Eloquent
 */
	class LogSaldo extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\Pedagang
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Tenongan\PedagangFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang newQuery()
 * @method static \Illuminate\Database\Query\Builder|Pedagang onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Pedagang withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Pedagang withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 */
	class Pedagang extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\Produk
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property int|null $produsen_id
 * @property string $harga_jual
 * @property string $harga_beli
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Tenongan\ProdukFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk newQuery()
 * @method static \Illuminate\Database\Query\Builder|Produk onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereHargaBeli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereHargaJual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereProdusenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Produk withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Produk withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @property-read \App\Models\Tenongan\Produsen|null $produsen
 */
	class Produk extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\Produsen
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Tenongan\ProdusenFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen newQuery()
 * @method static \Illuminate\Database\Query\Builder|Produsen onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Produsen withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Produsen withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\Produk[] $produk
 * @property-read int|null $produk_count
 */
	class Produsen extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\Saldo
 *
 * @property int $id
 * @property string $kode
 * @property string $saldo
 * @property int $pedagang_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogSaldo[] $logSaldo
 * @property-read int|null $log_saldo_count
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo newQuery()
 * @method static \Illuminate\Database\Query\Builder|Saldo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo wherePedagangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Saldo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Saldo withoutTrashed()
 * @mixin \Eloquent
 */
	class Saldo extends \Eloquent {}
}

namespace App\Models\Tenongan{
/**
 * App\Models\Tenongan\Transaksi
 *
 * @property int $id
 * @property string $kode
 * @property string $jumlah
 * @property int $produsen_id
 * @property string $tanggal
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereProdusenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereUpdatedAt($value)
 */
	class Transaksi extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OAuthProvider[] $oauthProviders
 * @property-read int|null $oauth_providers_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models\tenongan{
/**
 * App\Models\tenongan\Penjualan
 *
 * @property int $id
 * @property string $kode
 * @property int $produk_id
 * @property int $titip
 * @property int|null $laku
 * @property string $harga_jual
 * @property string $harga_beli
 * @property string $tanggal
 * @property string $keterangan
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $produsen_id
 * @property int|null $transaksi_id
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereHargaBeli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereHargaJual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereLaku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereProdukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereProdusenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereTitip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereTransaksiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereUpdatedAt($value)
 */
	class Penjualan extends \Eloquent {}
}


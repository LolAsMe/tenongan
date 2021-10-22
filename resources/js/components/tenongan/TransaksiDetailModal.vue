<template>
  <big-modal :name="name">
    <h5 slot="header">Detail Transaksi</h5>
    <div slot="body">
      {{ transaksi }}
      <table class="table table-sm">
        <thead>
          <tr v-if="transaksi.tipe == 'Produsen'">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Titip</th>
            <th scope="col">Laku</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Keterangan</th>
          </tr>
          <tr v-if="transaksi.tipe == 'Pedagang'">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Titip</th>
            <th scope="col">Laku</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Laba</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Keterangan</th>
          </tr>
        </thead>
        <tbody v-if="transaksi.tipe == 'Produsen'">
          <tr v-for="(penjualan, index) in penjualans" :key="penjualan.id">
            <td>{{ index + 1 }}</td>
            <td>{{ penjualan.produk }}</td>
            <td>{{ penjualan.tanggal }}</td>
            <td>{{ penjualan.titip }}</td>
            <td>{{ penjualan.laku }}</td>
            <td>{{ toCurrency(penjualan.harga_jual) }}</td>
            <td>{{ toCurrency(penjualan.harga_beli) }}</td>
            <td>{{ toCurrency(penjualan.harga_beli * penjualan.laku) }}</td>
            <td>{{ toCurrency(total[index]) }}</td>
            <td>{{ penjualan.Keterangan }}</td>
          </tr>
        </tbody>
        <tbody v-if="transaksi.tipe == 'Pedagang'">
          <tr v-for="(penjualan, index) in penjualans" :key="penjualan.id">
            <td>{{ index + 1 }}</td>
            <td>{{ penjualan.produk }}</td>
            <td>{{ penjualan.tanggal }}</td>
            <td>{{ penjualan.titip }}</td>
            <td>{{ penjualan.laku }}</td>
            <td>{{ toCurrency(penjualan.harga_jual) }}</td>
            <td>{{ toCurrency(penjualan.harga_beli) }}</td>
            <td>
              {{ toCurrency(penjualan.harga_jual - penjualan.harga_beli) }}
            </td>
            <td>
              {{
                toCurrency(
                  (penjualan.harga_jual - penjualan.harga_beli) * penjualan.laku
                )
              }}
            </td>
            <td>{{ toCurrency(total[index]) }}</td>
            <td>{{ penjualan.Keterangan }}</td>
          </tr>
        </tbody>
      </table>
      <div style="width:50%">
        Detail Transaksi Lain
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(penjualan, index) in penjualans" :key="penjualan.id">
              <td>{{ index + 1 }}</td>
              <td>keteranan</td>
              <td>Jumlah</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="width:30%">
        <div>Julah</div>
        <div>Lain</div>
        <div>Kemarin</div>
        <div>Total</div>
      </div>
    </div>
  </big-modal>
</template>

<script>
import BigModal from "~/components/tenongan/BigModal";

export default {
  name: "TransaksiDetailModal",
  components: {
    BigModal,
  },
  data() {
    return {
      showModal: false,
    };
  },
  computed: {
    penjualans: function () {
      let penjualan = this.$store.getters["transaksi/transaksi"].penjualan
      // console.log(penjualan.sort())
      penjualan.sort((a, b) => a.produk.localeCompare(b.produk))
      return penjualan;
    },
    total: function () {
      if (this.transaksi) {
        let totals = [];
        let total = 0;
        let penjualansLength = this.penjualans.length;
        if (this.transaksi.tipe == "Pedagang") {
          for (let index = 0; index < penjualansLength; index++) {
            const penjualan = this.penjualans[index];
            total +=
              (penjualan.harga_jual - penjualan.harga_beli) * penjualan.laku;
            totals.push(total);
          }
        }
        if (this.transaksi.tipe == "Produsen") {
          for (let index = 0; index < penjualansLength; index++) {
            const penjualan = this.penjualans[index];
            total += penjualan.harga_beli * penjualan.laku;
            totals.push(total);
          }
        }
        return totals;
      }
    },
  },
  props: {
    transaksi: { type: Object, default: null },
    name: { type: String, default: null },
  },
  methods: {},
};
</script>

<style scoped>
.modal-container {
  width: 20%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
</style>

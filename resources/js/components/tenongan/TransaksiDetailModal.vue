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
      <h6>
        Detail Transaksi Lain
        <fa @click="showAddDetail = true" :icon="['fa', 'plus']" />
      </h6>
      <div v-show="showAddDetail">
        <div class="form-floating mb-3">
          <input
            v-model="form.keterangan"
            type="text"
            class="form-control"
            placeholder="keterangan"
          />
          <label for="floatingInput">keterangan</label>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="form.jumlah"
            type="text"
            class="form-control"
            placeholder="jumlah"
          />
          <label for="floatingInput">jumlah</label>
        </div>
        <input
          @click="addDetail"
          type="submit"
          class="btn btn-primary btn-sm"
          value="Add"
        />
      </div>
      <div class="d-flex">
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(detail, index) in details" :key="detail.id">
              <td>{{ index + 1 }}</td>
              <td>{{ detail.keterangan }}</td>
              <td>{{ toCurrency(detail.jumlah) }}</td>
              <td>{{ toCurrency(totalDetail[index]) }}</td>
            </tr>
          </tbody>
        </table>

        <div style="width: 44%" class="d-inline-block p-4">
          <div>
            Jumlah
            <span style="float: right">{{
              toCurrency(total[this.penjualans.length - 1])
            }}</span>
          </div>
          <div v-show="this.totalDetail">
            Lain
            <span style="float: right">{{
              toCurrency(
                totalDetail[this.totalDetail.length - 1] -
                  total[this.total.length - 1]
              )
            }}</span>
          </div>
          <div>
            Kemarin<span style="float: right">{{
              toCurrency(-transaksi.kemarin)
            }}</span>
          </div>
          <div>
            Kas<span style="float: right">{{ toCurrency(-kas) }}</span>
          </div>
          <div class="border-bottom">Bulat<span style="float: right">{{
              toCurrency(transaksi.pembulatan)
            }}</span></div>
          <div>
            Total<span style="float: right">{{
              toCurrency(totalTransaksi)
            }}</span>
          </div>
        </div>
      </div>
    </div>
  </big-modal>
</template>

<script>
import Form from "vform";
import BigModal from "~/components/tenongan/BigModal";

export default {
  name: "TransaksiDetailModal",
  components: {
    BigModal,
  },
  data() {
    return {
      showModal: false,
      showAddDetail: false,
      form: new Form(),
    };
  },
  computed: {
    penjualans: function () {
      let penjualan = this.$store.getters["transaksi/transaksi"].penjualan;
      penjualan.sort((a, b) => a.produk.localeCompare(b.produk));
      return penjualan;
    },
    details: function () {
      let detail = this.$store.getters["transaksi/transaksi"].detail;
      return detail;
    },
    kas: function () {
      let kas = this.$store.getters["transaksi/transaksi"].kas;
      return kas;
    },
    totalTransaksi: function () {
      return (
        parseInt(this.totalDetail[this.totalDetail.length - 1])
        - parseInt(this.kas)
        - parseInt(this.transaksi.kemarin) +parseInt(this.transaksi.pembulatan)
      );
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
    totalDetail: function () {
      if (this.transaksi && this.total) {
        let totalDetails = [];
        let total = this.total[this.penjualans.length - 1];
        let detailsLength = this.details.length;
        if (detailsLength == 0) {
          totalDetails.push(total);
        } else {
          for (let index = 0; index < detailsLength; index++) {
            let detail = this.details[index];
            total = parseInt(total) + parseInt(detail.jumlah);
            totalDetails.push(total);
          }
          return totalDetails;
        }
      }
      return [this.total[this.penjualans.length - 1]];
    },
  },
  props: {
    transaksi: { type: Object, default: null },
    name: { type: String, default: null },
  },
  methods: {
    async addDetail() {
      let data = await this.form.post(
        "api/transaksi/" + this.transaksi.id + "/detail"
      );
      this.$store.dispatch("transaksi/fetchTransaksi", this.transaksi.id);
      this.form.reset();
      this.showAddDetail = false;
    },
  },
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

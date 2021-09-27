<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Penjualan</h2></div>
        <div class="p-2 bd-highlight" v-if="isRole('Admin')">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <button class="btn btn-primary" @click="transact">Transact</button>
          <button class="btn btn-primary" @click="pay">Pay</button>
          <add-penjualan-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-penjualan-modal>
          <button
            class="btn btn-primary"
            @click="$refs.uploadModal.$data.showModal = true"
            v-if="isRole('Admin')"
          >
            Import
          </button>

          <upload-modal v-if="isRole('Admin')" ref="uploadModal" :url="'penjualan'"></upload-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Penjualan'">
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Titip</th>
              <th scope="col">Laku</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Harga Beli</th>
              <th scope="col">Nama Pedagang</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody v-if="isRole('Admin')">
            <tr v-for="penjualan in penjualans" :key="penjualan.id">
              <td>{{ penjualan.tanggal }}</td>
              <td>{{ penjualan.produk.nama }}</td>
              <td>{{ penjualan.titip }}</td>
              <td>{{ penjualan.laku }}</td>
              <td>{{ penjualan.harga_jual }}</td>
              <td>{{ penjualan.harga_beli }}</td>
              <td>{{ penjualan.pedagang.nama }}</td>
              <td>{{ penjualan.status }}</td>
            </tr>
          </tbody>
          <tbody v-if="isRole('Produsen')">
            <tr v-for="penjualan in penjualans" :key="penjualan.id">
              <td>{{ penjualan.tanggal }}</td>
              <td>{{ penjualan.produk.nama }}</td>
              <td>{{ penjualan.titip }}</td>
              <td>{{ penjualan.laku }}</td>
              <td>{{ penjualan.harga_jual }}</td>
              <td>{{ penjualan.harga_beli }}</td>
              <td>{{ penjualan.pedagang.nama }}</td>
              <td>{{ penjualan.status }}</td>
            </tr>
          </tbody>
          <tbody v-if="isRole('Pedagang')">
            <tr v-for="penjualan in penjualans" :key="penjualan.id">
              <td>{{ penjualan.tanggal }}</td>
              <td>{{ penjualan.produk.nama }}</td>
              <td>{{ penjualan.titip }}</td>
              <td>{{ penjualan.laku }}</td>
              <td>{{ penjualan.harga_jual }}</td>
              <td>{{ penjualan.harga_beli }}</td>
              <td>{{ penjualan.pedagang.nama }}</td>
              <td>{{ penjualan.status }}</td>
            </tr>
          </tbody>
        </table>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddPenjualanModal from "~/components/tenongan/AddPenjualanModal";
import UploadModal from "~/components/tenongan/UploadModal";
import Dropdown from "~/components/Dropdown";
import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddPenjualanModal,
    UploadModal,
    Dropdown,
  },
  computed: mapGetters({
    penjualans: "penjualan/penjualans",
  }),
  data() {
    return {
      dataAdd: new Object(),
      showAddModal: false,
    };
  },
  methods: {
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    async transact() {
      const { data } = await axios.post("api/transaksi/penjualan/transact");
      this.$store.dispatch("penjualan/fetchPenjualan");
    },
    async pay() {
      const { data } = await axios.post("api/transaksi/penjualan/transact/pay");
      this.$store.dispatch("penjualan/fetchPenjualan");
    },
  },
  created() {
    this.$store.dispatch("penjualan/fetchPenjualan");
  },
  metaInfo() {
    return { title: "Penjualan" };
  },
};
</script>

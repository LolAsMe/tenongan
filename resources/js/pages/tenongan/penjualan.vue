<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Penjualan</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <button class="btn btn-primary" @click="transact">Transact</button>
          <button class="btn btn-primary" @click="pay">Pay</button>
          <add-penjualan-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-penjualan-modal>
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
          <tbody>
            <tr v-for="penjualan in penjualans" :key="penjualan.id">
              <td>{{ penjualan.tanggal }}</td>
              <td>{{ penjualan.produk.nama }}</td>
              <td>{{ penjualan.titip }}</td>
              <td>{{ penjualan.laku }}</td>
              <td>{{ penjualan.harga_jual }}</td>
              <td>{{ penjualan.harga_beli }}</td>
              <td>{{ penjualan.pedagang.nama }}</td>
              <td>{{ penjualan.status }}</td>
              <!-- <td class="col-4">
                <dropdown name="Action">
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="togglePenjualanModal(), setDataLihat(penjualan)"
                    >
                      Lihat
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleEditModal(), setDataEdit(penjualan)"
                    >
                      Edit
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="deletePenjualan(penjualan.id)"
                    >
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td> -->
            </tr>
          </tbody>
        </table>
        <lihat-penjualan-modal
          ref="penjualanModal"
          :penjualan="dataLihat"
          :showModal="showPenjualanModal"
          @toggle="togglePenjualanModal"
        ></lihat-penjualan-modal>
        <edit-penjualan-modal
          ref="editModal"
          :penjualan="dataEdit"
          :showModal="showEditModal"
          @toggle="toggleEditModal"
        ></edit-penjualan-modal>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddPenjualanModal from "~/components/tenongan/AddPenjualanModal";
import LihatPenjualanModal from "~/components/tenongan/LihatPenjualanModal";
import EditPenjualanModal from "~/components/tenongan/EditPenjualanModal";
import Dropdown from "~/components/Dropdown";
import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddPenjualanModal,
    LihatPenjualanModal,
    EditPenjualanModal,
    Dropdown,
  },
  computed: mapGetters({
    penjualans: "penjualan/penjualans",
  }),
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showPenjualanModal: false,
    };
  },
  methods: {
    async deletePenjualan(id) {
      const { data } = await axios.delete("api/penjualan/" + id);
      await this.$store.commit("penjualan/deletePenjualan", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setPenjualan(obj);
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal() {
      this.showEditModal = !this.showEditModal;
    },
    togglePenjualanModal() {
      this.showPenjualanModal = !this.showPenjualanModal;
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

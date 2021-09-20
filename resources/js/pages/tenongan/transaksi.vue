<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Transaksi</h2></div>
        <div class="p-2 bd-highlight">
          <!-- <button class="btn btn-primary" @click="toggleAddModal">
            Add
          </button>
          <add-transaksi-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-transaksi-modal> -->
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar transaksi'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Tipe</th>
              <th scope="col">Nama</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="transaksi in transaksis" :key="transaksi.id">
              <td>{{ transaksi.tanggal }}</td>
              <td>{{ transaksi.tipe }}</td>
              <td>{{ transaksi.owner.nama }}</td>
              <td>{{ transaksi.jumlah }}</td>
              <td>{{ transaksi.status }}</td>
              <!-- <td>
                <dropdown name="Action">
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleTransaksiModal(), setDataLihat(transaksi)"
                    >
                      Lihat
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleEditModal(), setDataEdit(transaksi)"
                    >
                      Edit
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" @click="deleteTransaksi(transaksi.id)">
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td> -->
            </tr>
          </tbody>
        </table>
      </card>
      <!-- <lihat-transaksi-modal
        ref="transaksiModal"
        :transaksi="dataLihat"
        :showModal="showTransaksiModal"
        @toggle="toggleTransaksiModal"
      ></lihat-transaksi-modal>
      <edit-transaksi-modal
        ref="editModal"
        :transaksi="dataEdit"
        :showModal="showEditModal"
        @toggle="toggleEditModal"
      ></edit-transaksi-modal> -->
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
// import AddTransaksiModal from "~/components/tenongan/AddTransaksiModal";
// import LihatTransaksiModal from "~/components/tenongan/LihatTransaksiModal";
// import EditTransaksiModal from "~/components/tenongan/EditTransaksiModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    // AddTransaksiModal,
    // LihatTransaksiModal,
    // EditTransaksiModal,
    Dropdown,
  },
  computed: mapGetters({
    transaksis: "transaksi/transaksis",
  }),
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showTransaksiModal: false,
      loading: true,
    };
  },
  methods: {
    async deleteTransaksi(id) {
      const { data } = await axios.delete("api/transaksi/" + id);
      await this.$store.commit("transaksi/deleteTransaksi", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setTransaksi(obj)
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal(){
      this.showEditModal = !this.showEditModal
    },
    toggleTransaksiModal(){
      this.showTransaksiModal = !this.showTransaksiModal
    },
  },
  created() {
    this.$store.dispatch("transaksi/fetchTransaksis");
    this.loading = false
  },
  metaInfo() {
    return { title: "Transaksi" };
  },
};
</script>

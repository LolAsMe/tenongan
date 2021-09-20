<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Kas {{kas.nama}}</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" @click="toggleTambahModal">Tambah</button>
          <button class="btn btn-primary">Kurang</button>
          <tambah-kas-modal
            :showModal="showTambahModal"
            @toggle="toggleTambahModal"
          ></tambah-kas-modal>
        </div>
      </div>
      <div class="col-12 p-2">
      Jumlah Kas {{ kas.jumlah }}
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Log Kas'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Kode</th>
              <th scope="col">Payer</th>
              <th scope="col">Tipe</th>
              <th scope="col">Jumlah</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="log in kas.log" :key="log.id">
              <td>{{ log.kode }}</td>
              <td>{{ log.payer.nama }}</td>
              <td>{{ log.payer_type }}</td>
              <td>{{ log.jumlah }}</td>
            </tr>
          </tbody>
        </table>
      </card>
      <!-- <log-kas-modal
        ref="kasModal"
        @toggle="toggleKasModal"
        :showModal="showKasModal"
        :kas="kas"
      ></log-kas-modal> -->
      <!-- <edit-kas-modal
        ref="editModal"
        :kas="dataEdit"
        :showModal="showEditModal"
        @toggle="toggleEditModal"
      ></edit-kas-modal> -->
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import TambahKasModal from "~/components/tenongan/TambahKasModal";
// import LogKasModal from "~/components/tenongan/LogKasModal";
// import EditKasModal from "~/components/tenongan/EditKasModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    // Modal,
    TambahKasModal,
    // LogKasModal,
    // EditKasModal,
    Dropdown,
  },
  computed: mapGetters({
    kas: "kas/kas",
  }),
  data() {
    return {
      dataTambah: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showTambahModal: false,
      showEditModal: false,
      showKasModal: false,
      loading: true
    };
  },
  methods: {
    async deleteKas(id) {
      const { data } = await axios.delete("api/kas/" + id);
      await this.$store.commit("kas/deleteKas", id);
    },
    setDataTambah(obj) {
      this.dataTambah = obj;
    },
    async setKas(id) {
      await this.$store.dispatch("kas/fetchKas", id);
      this.$refs.kasModal.loading = false;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setKas(obj);
    },
    toggleTambahModal() {
      this.showTambahModal = !this.showTambahModal;
    },
    toggleEditModal() {
      this.showEditModal = !this.showEditModal;
    },
    toggleKasModal() {
      this.showKasModal = !this.showKasModal;
    },
  },
  created() {
    this.$store.dispatch("kas/fetchKas");
    this.loading=false
  },
  metaInfo() {
    return { title: "Kas" };
  },
};
</script>

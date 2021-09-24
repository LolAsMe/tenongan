<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Saldo</h2></div>

        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <add-saldo-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-saldo-modal>
        </div>
      </div>
    </div>
    <div class="col-12" v-if="isRole('Pedagang') || isRole('Produsen')">Jumlah Saldo: {{saldo.jumlah}}</div>
    <div class="col-12 mt-2">
      <card :title="'Daftar saldo'" v-if="isRole('Admin')">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Tipe</th>
              <th scope="col">Saldo</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="saldo in saldos" :key="saldo.id">
              <td>{{ saldo.id }}</td>
              <td>{{ saldo.owner.nama }}</td>
              <td>{{ saldo.tipe }}</td>
              <td>{{ saldo.jumlah }}</td>
              <!-- <td>{{ saldo.pedagang.nama }}</td> -->
              <td>
                <a
                  class="btn btn-primary btn-sm"
                  @click="toggleSaldoModal(), setSaldo(saldo.id)"
                >
                  Lihat
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <log-saldo-modal
          ref="saldoModal"
          @toggle="toggleSaldoModal"
          :showModal="showSaldoModal"
          :saldo="saldo"
        ></log-saldo-modal>
      </card>
      <card
        :title="'Log saldo'"
        v-if="isRole('Produsen') || isRole('Pedagang')"
      >
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Tanggal</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="log in saldo.log" :key="log.id">
              <td>{{ log.id }}</td>
              <td>{{ log.keterangan }}</td>
              <td>{{ log.jumlah }}</td>
              <td>{{ log.tanggal }}</td>
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
import AddSaldoModal from "~/components/tenongan/AddSaldoModal";
import LogSaldoModal from "~/components/tenongan/LogSaldoModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddSaldoModal,
    LogSaldoModal,
    Dropdown,
  },
  computed: mapGetters({
    saldos: "saldo/saldos",
    saldo: "saldo/saldo",
  }),
  data() {
    return {
      showAddModal: false,
      showSaldoModal: false,
      loading: true,
    };
  },
  methods: {
    async deleteSaldo(id) {
      const { data } = await axios.delete("api/saldo/" + id);
      await this.$store.commit("saldo/deleteSaldo", id);
    },
    async setSaldo(id) {
      await this.$store.dispatch("saldo/fetchSaldo", id);
      this.$refs.saldoModal.loading = false;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setSaldo(obj);
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleSaldoModal() {
      this.showSaldoModal = !this.showSaldoModal;
    },
  },
  created() {
    this.$store.dispatch("saldo/fetchSaldos");
    this.$store.dispatch("saldo/fetchSaldo",1);
    this.loading = false;
  },
  metaInfo() {
    return { title: "Saldo" };
  },
};
</script>

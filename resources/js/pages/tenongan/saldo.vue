<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Saldo</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" @click="toggleAddModal">
            Add
          </button>
          <add-saldo-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-saldo-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar saldo'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Kode</th>
              <th scope="col">Saldo</th>
              <th scope="col">Nama Pedagang</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="saldo in saldos" :key="saldo.id">
              <td>{{ saldo.id }}</td>
              <td>{{ saldo.kode }}</td>
              <td>{{ saldo.saldo }}</td>
              <td>{{ saldo.pedagang.nama }}</td>
              <td><a
                      class="btn btn-primary btn-sm"
                      @click="toggleSaldoModal(), setSaldo(saldo.id)"
                    >
                      Lihat
                    </a></td>
              <!-- <td>
                <dropdown name="Action">
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleSaldoModal(), setDataLihat(saldo)"
                    >
                      Lihat
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleEditModal(), setDataEdit(saldo)"
                    >
                      Edit
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" @click="deleteSaldo(saldo.id)">
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td> -->
            </tr>
          </tbody>
        </table>
      </card>
      <log-saldo-modal
        ref="saldoModal"
        @toggle="toggleSaldoModal"
        :showModal="showSaldoModal"
        :saldo="saldo"
      ></log-saldo-modal>
      <!-- <edit-saldo-modal
        ref="editModal"
        :saldo="dataEdit"
        :showModal="showEditModal"
        @toggle="toggleEditModal"
      ></edit-saldo-modal> -->
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddSaldoModal from "~/components/tenongan/AddSaldoModal";
import LogSaldoModal from "~/components/tenongan/LogSaldoModal";
// import EditSaldoModal from "~/components/tenongan/EditSaldoModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddSaldoModal,
    LogSaldoModal,
    // EditSaldoModal,
    Dropdown,
  },
  computed: mapGetters({
    saldos: "saldo/saldos",
    saldo: "saldo/saldo",
  }),
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showSaldoModal: false,
    };
  },
  methods: {
    async deleteSaldo(id) {
      const { data } = await axios.delete("api/saldo/" + id);
      await this.$store.commit("saldo/deleteSaldo", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    async setSaldo(id) {
    await this.$store.dispatch("saldo/fetchSaldo",id);
    this.$refs.saldoModal.loading=false
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setSaldo(obj)
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal(){
      this.showEditModal = !this.showEditModal
    },
    toggleSaldoModal(){
      this.showSaldoModal = !this.showSaldoModal
    },
  },
  created() {
    this.$store.dispatch("saldo/fetchSaldos");
  },
  metaInfo() {
    return { title: "Saldo" };
  },
};
</script>

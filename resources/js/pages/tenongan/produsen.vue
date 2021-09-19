<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produsen</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <add-produsen-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-produsen-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Produsen'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Kode</th>
              <th scope="col">Nama</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="produsen in produsens" :key="produsen.id">
              <td class="col-1">{{ produsen.id }}</td>
              <td class="col-3">{{ produsen.kode }}</td>
              <td class="col-4">{{ produsen.nama }}</td>
              <td class="col-4">
                <dropdown name="Action">
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleProdusenModal(), setDataLihat(produsen)"
                    >
                      Lihat
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleEditModal(), setDataEdit(produsen)"
                    >
                      Edit
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="deleteProdusen(produsen.id)"
                    >
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td>
            </tr>
          </tbody>
        </table>
        <lihat-produsen-modal ref="produsenModal" :produsen="dataLihat" :showModal="showProdusenModal" @toggle="toggleProdusenModal"></lihat-produsen-modal>
        <edit-produsen-modal ref="editModal" :produsen="dataEdit" :showModal="showEditModal" @toggle="toggleEditModal"></edit-produsen-modal>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddProdusenModal from "~/components/tenongan/AddProdusenModal";
import LihatProdusenModal from "~/components/tenongan/LihatProdusenModal";
import EditProdusenModal from "~/components/tenongan/EditProdusenModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddProdusenModal,
    LihatProdusenModal,
    EditProdusenModal,
    Dropdown,
  },
  computed: mapGetters({
    produsens: "produsen/produsens",
  }),
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showProdusenModal: false,
    };
  },
  methods: {
    async deleteProdusen(id) {
      const { data } = await axios.delete("api/produsen/" + id);
      await this.$store.commit("produsen/deleteProdusen", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setProdusen(obj)
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal(){
      this.showEditModal = !this.showEditModal
    },
    toggleProdusenModal(){
      this.showProdusenModal = !this.showProdusenModal
    },
  },
  created() {
    this.$store.dispatch("produsen/fetchProdusen");
  },
  metaInfo() {
    return { title: "Produsen" };
  },
};
</script>

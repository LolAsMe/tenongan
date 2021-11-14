<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        {{rutinitass}}
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Rutinitas</h2></div>
        <div class="p-2 bd-highlight" v-role="'Admin'">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <add-rutinitas-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-rutinitas-modal>
          <button
            class="btn btn-primary"
            @click="$refs.uploadModal.$data.showModal = true"
            v-if="isRole('Admin')"
          >
            Import
          </button>

          <upload-modal
            v-if="isRole('Admin')"
            ref="uploadModal"
            :url="'rutinitas'"
          ></upload-modal
          >
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Rutinitas'">
        <v-table
          :items="items"
          :itemsTitle="itemsTitle"
          :isAction="isRole('Admin')"
        >
          <template v-slot:action="action">
            <td>
              <dropdown name="Action">
                <li>
                  <a
                    type="button"
                    class="dropdown-item"
                    @click="toggleRutinitasModal(), setDataLihat(action.data)"
                  >
                    Lihat
                  </a>
                </li>
                <li>
                  <a
                    type="button"
                    class="dropdown-item"
                    @click="toggleEditModal(), setDataEdit(action.data)"
                  >
                    Edit
                  </a>
                </li>
                <li>
                  <a
                    type="button"
                    class="dropdown-item"
                    @click="deleteRutinitas(action.data.id)"
                  >
                    Hapus
                  </a>
                </li>
              </dropdown>
            </td>
          </template>
        </v-table>
      </card>
      <!-- <lihat-rutinitas-modal
        ref="rutinitasModal"
        :rutinitas="dataLihat"
        :showModal="showRutinitasModal"
        @toggle="toggleRutinitasModal"
      ></lihat-rutinitas-modal>
      <edit-rutinitas-modal
        ref="editModal"
        :rutinitas="dataEdit"
        :showModal="showEditModal"
        @toggle="toggleEditModal"
      ></edit-rutinitas-modal> -->
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddRutinitasModal from "~/components/tenongan/AddRutinitasModal";
// import LihatRutinitasModal from "~/components/tenongan/LihatRutinitasModal";
// import EditRutinitasModal from "~/components/tenongan/EditRutinitasModal";
import UploadModal from "~/components/tenongan/UploadModal";
import VTable from "~/components/VTable";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddRutinitasModal,
    // LihatRutinitasModal,
    // EditRutinitasModal,
    VTable,
    UploadModal,
    Dropdown,
  },
  computed: {
    ...mapGetters({
      rutinitass: "rutinitas/rutinitass",
    }),
    items: function () {
      if (!this.loading && this.rutinitass) {
        return this.rutinitass.map(({ id, keterangan, jumlah, frekuensi, sender }) => {
          return { id, keterangan, jumlah, frekuensi, sender };
        });
      }
    },
    itemsTitle: function () {
      return ["ID", "Keterangan", "Jumlah", "Frekuensi","Sender"];
    },
  },
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showRutinitasModal: false,
      loading: true,
      role: null,
    };
  },
  methods: {
    async deleteRutinitas(id) {
      const { data } = await axios.delete("api/rutinitas/" + id);
      await this.$store.commit("rutinitas/deleteRutinitas", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setRutinitas(obj);
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal() {
      this.showEditModal = !this.showEditModal;
    },
    toggleRutinitasModal() {
      this.showRutinitasModal = !this.showRutinitasModal;
    },
  },
  created() {
    this.$store.dispatch("rutinitas/fetchRutinitass");
    this.role = this.$store.getters["auth/user"].tipe;
    this.loading = false;
  },
  metaInfo() {
    return { title: "Rutinitas" };
  },
};
</script>

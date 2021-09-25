<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Pedagang</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" v-if="isRole('Admin')" @click="toggleAddModal">Add</button>
          <button class="btn btn-primary" v-if="isRole('Admin')" @click="showModal">Import</button>
          <add-pedagang-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-pedagang-modal>
          <upload-modal
          v-if="isRole('Admin')"
          ref="uploadModal"
          :url="'pedagang'"
          ></upload-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Pedagang'">
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
                    @click="togglePedagangModal(), setDataLihat(action.data)"
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
                    @click="deletePedagang(action.data.id)"
                  >
                    Hapus
                  </a>
                </li>
              </dropdown>
            </td>
          </template>
        </v-table>
        <lihat-pedagang-modal
          ref="pedagangModal"
          :pedagang="dataLihat"
          :showModal="showPedagangModal"
          @toggle="togglePedagangModal"
        ></lihat-pedagang-modal>
        <edit-pedagang-modal
          ref="editModal"
          :pedagang="dataEdit"
          :showModal="showEditModal"
          @toggle="toggleEditModal"
        ></edit-pedagang-modal>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddPedagangModal from "~/components/tenongan/AddPedagangModal";
import LihatPedagangModal from "~/components/tenongan/LihatPedagangModal";
import EditPedagangModal from "~/components/tenongan/EditPedagangModal";
import UploadModal from "~/components/tenongan/UploadModal";
import VTable from "~/components/VTable";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddPedagangModal,
    LihatPedagangModal,
    UploadModal,
    EditPedagangModal,
    Dropdown,
    VTable,
  },
  computed: {
    ...mapGetters({
      pedagangs: "pedagang/pedagangs",
    }),
    items: function () {
      if (!this.loading && this.pedagangs) {
        return this.pedagangs.map(({ id, nama }) => {
          return { id, nama };
        });
      }
    },
    itemsTitle: function () {
      return ["ID", "Nama"];
    }
  },
  data() {
    return {
      dataLihat: { id: 0, nama: "null", created_at: "tet", updated_at: "tet" },
      dataEdit: { id: 0, nama: "null", created_at: "tet", updated_at: "tet" },
      showAddModal: false,
      showEditModal: false,
      showPedagangModal: false,
      loading: true,
    };
  },
  methods: {
    async deletePedagang(id) {
      const { data } = await axios.delete("api/pedagang/" + id);
      await this.$store.commit("pedagang/deletePedagang", id);
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setPedagang(obj);
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal() {
      this.showEditModal = !this.showEditModal;
    },
    togglePedagangModal() {
      this.showPedagangModal = !this.showPedagangModal;
    },
    showModal(){
      this.$refs.uploadModal.$data.showModal = true
    }
  },
  created() {
    this.$store.dispatch("pedagang/fetchPedagangs");
    this.loading = false;
  },
  metaInfo() {
    return { title: "Pedagang" };
  },
};
</script>

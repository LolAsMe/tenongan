<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produsen</h2></div>
        <div class="p-2 bd-highlight">
          <add-produsen-modal></add-produsen-modal>
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
                <lihat-produsen-modal :produsen="produsen" class="d-inline"></lihat-produsen-modal>
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  @click="(showEditModal = true), setProdusen(produsen)"
                >
                  Edit
                </button>
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  @click="deleteProdusen(produsen.id)"
                >
                  Hapus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </card>
    </div>
    <modal v-if="showProdusen" @close="showProdusen = false">
      <h5 slot="header">Produsen</h5>
      <div slot="body">
        <h6>Detail Produsen</h6>
        {{ dataProdusen }}
      </div>
      <div slot="footer">
        <button class="btn btn-secondary btn-sm" @click="showProdusen = false">
          Close Modal
        </button>
      </div>
    </modal>
    <modal v-if="showEditModal" @close="showEditModal = false">
      <h5 slot="header">Edit Produsen</h5>
      <div slot="body">
        <form
          id="editForm"
          @submit.prevent="editProdusen"
          @keydown="form.onKeydown($event)"
        >
          <div class="form-floating mb-3">
            <input
              v-model="formEdit.kode"
              type="text"
              class="form-control"
              placeholder="kode"
            />
            <label for="floatingInput">Kode</label>
          </div>
          <div class="form-floating mb-3">
            <input
              v-model="formEdit.nama"
              type="text"
              class="form-control"
              placeholder="nama"
            />
            <label for="floatingInput">Nama</label>
          </div>
        </form>
      </div>
      <div slot="footer">
        <button class="btn btn-secondary btn-sm" @click="showEditModal = false">
          Close Modal
        </button>
        <input
          type="submit"
          class="btn btn-primary btn-sm"
          @click="showEditModal = false"
          form="editForm"
          value="Edit"
        />
      </div>
    </modal>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddProdusenModal from "~/components/tenongan/AddProdusenModal";
import LihatProdusenModal from "~/components/tenongan/LihatProdusenModal";
import BasicModal from "~/components/tenongan/BasicModal";

import Form from "vform";
import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddProdusenModal,
    BasicModal,
    LihatProdusenModal,
  },
  computed: mapGetters({
    produsens: "produsen/produsens",
  }),
  data() {
    return {
      showProdusen: false,
      showEditModal: false,
      dataProdusen: "",

      formEdit: new Form({
        id: "",
        kode: "",
        nama: "",
      }),
    };
  },
  methods: {
    async editProdusen() {
      const { data } = await this.formEdit.patch(
        "api/produsen/" + this.formEdit.id
      );
      await this.$store.commit("produsen/editProdusen", data);
      await this.formEdit.reset();
    },
    setProdusen(produsen) {
      this.formEdit.id = produsen.id;
      this.formEdit.kode = produsen.kode;
      this.formEdit.nama = produsen.nama;
    },
    async deleteProdusen(id) {
      const { data } = await axios.delete("api/produsen/" + id);
      await this.$store.commit("produsen/deleteProdusen", id);
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

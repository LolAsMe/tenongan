<template>
  <!-- <div class="form-check">
    <input
      :id="id || name"
      :name="name"
      :checked="internalValue"
      type="checkbox"
      class="form-check-input"
      @click="handleClick"
    >
    <label :for="id || name" class="form-check-label">
      <slot />
    </label>
  </div> -->
  <div>
     <basic-modal buttonShowName="Tambah">
      <h5 slot="header">Tambah Produsen</h5>
      <div slot="body">
        <form id="addForm" @submit.prevent="addProdusen" @keydown="form.onKeydown($event)">
          <div class="form-floating mb-3">
            <input v-model="form.kode" type="text" class="form-control" placeholder="kode" />
            <label for="floatingInput">Kode</label>
          </div>
          <div class="form-floating mb-3">
            <input v-model="form.nama" type="text" class="form-control" placeholder="nama" />
            <label for="floatingInput">Nama</label>
          </div>
        </form>
      </div>
      <div slot="footer">
        <button class="btn btn-secondary btn-sm">
          Close Modal
        </button>
        <!-- <fa class="float-end" icon="['far', 'times-circle']" /> -->

        <input type="submit" class="btn btn-primary btn-sm" form="addForm" value="Tambah">
      </div>
          </basic-modal>
    <!-- <button  type="button" class="btn btn-primary" @click="showAddModal = true">
      Tambah
    </button>
    <modal v-if="showAddModal" @close="showAddModal = false">

    </modal> -->
  </div>
</template>

<script>
import Modal from '~/components/Modal'
import BasicModal from '~/components/tenongan/BasicModal'
import Form from "vform";

export default {
  name: "AddProdusenModal",
  components: {
    Modal,BasicModal
  },
  data(){
    return {
      form: new Form({
      }),

    }
  },
  methods:{
    async addProdusen(){
      const {data} = await this.form.post('api/produsen');
      await this.$store.commit('produsen/addProdusen',data);
      await this.form.reset()
    },
  }

  // props: {
  //   id: { type: String, default: null },
  //   name: { type: String, default: "checkbox" },
  //   value: { type: Boolean, default: false },
  //   checked: { type: Boolean, default: false },
  // },

  // data: () => ({
  //   internalValue: false,
  // }),

  // watch: {
  //   value(val) {
  //     this.internalValue = val;
  //   },

  //   checked(val) {
  //     this.internalValue = val;
  //   },

  //   internalValue(val, oldVal) {
  //     if (val !== oldVal) {
  //       this.$emit("input", val);
  //     }
  //   },
  // },

  // created() {
  //   this.internalValue = this.value;

  //   if ("checked" in this.$options.propsData) {
  //     this.internalValue = this.checked;
  //   }
  // },

  // methods: {
  //   handleClick(e) {
  //     this.$emit("click", e);

  //     if (!e.isPropagationStopped) {
  //       this.internalValue = e.target.checked;
  //     }
  //   },
  // },
};
</script>

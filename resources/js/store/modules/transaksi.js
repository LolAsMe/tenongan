import axios from 'axios'
import store from '~/store'

// state
export const state = {
  transaksis: [
  ],
  transaksi: {
    "id": 39,
    "tanggal": "2021-10-21 20:08:30",
    "tipe": "Pedagang",
    "jumlah": "Rp 3.800,00",
    "status": "Pending",
    "penjualan": [
      {
        "id": 87,
        "titip": 2,
        "laku": 2,
        "harga_jual": "1500.00",
        "harga_beli": "1200.00",
        "tanggal": "2021-10-21 20:08:28",
        "status": "Pending",
        "keterangan": null,
        "updated_at": "2021-10-21T13:08:30.000000Z",
        "created_at": "2021-10-21T13:08:28.000000Z",
        "produk": "Nyess"
      },
    ],
    "detail": [
      {
        "id": 1,
        "transaksi_id": 39,
        "keterangan": "COba2",
        "jumlah": "10000.00",
        "deleted_at": null,
        "created_at": "2021-10-22T14:40:24.000000Z",
        "updated_at": "2021-10-22T14:40:24.000000Z"
      }
    ],
    "keterangan": null
  }

}

// getters
export const getters = {
  transaksis: state => state.transaksis,
  transaksi: state => state.transaksi,
}

// mutations
export const mutations = {
  setTransaksis: (state, transaksis) => (state.transaksis = transaksis),
  setTransaksi: (state, transaksi) => (state.transaksi = transaksi),
  addSaldo: (state, transaksi) => state.transaksis.push(transaksi),
  editSaldo(state, nSaldo) {
    const oldSaldo = state.transaksis.find(transaksi => transaksi.id === nSaldo.id);
    if (oldSaldo) {
      // not creating a new object but modifying old object here
      Object.assign(oldSaldo, nSaldo)
    }
  },
  deleteSaldo: (state, id) => state.transaksis = state.transaksis.filter(transaksi => transaksi.id !== id)
}

// actions
export const actions = {
  async fetchTransaksis({ commit }) {

    let id = store.getters['auth/user'].owner_id
    let role = store.getters['auth/user'].tipe
    let data = []
    if (role == 'Admin') {
      data = (await axios.get('/api/transaksi')).data
    }
    if (role == 'Produsen') {
      data = (await axios.get('/api/produsen/transaksi/' + id)).data
    }
    if (role == 'Pedagang') {
      data = (await axios.get('/api/pedagang/transaksi/' + id)).data
    }
    commit('setTransaksis', data.data)
  },
  async fetchTransaksi({ commit }, id) {
    let response = (await axios.get('/api/transaksi/penjualan/' + id))
    commit('setTransaksi', response.data.data)
  }
}

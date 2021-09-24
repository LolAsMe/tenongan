import axios from 'axios'
import store from '~/store'

// state
export const state = {
  transaksis: [
  ],

}

// getters
export const getters = {
  transaksis: state => state.transaksis,
}

// mutations
export const mutations = {
  setTransaksi: (state, transaksis) => (state.transaksis = transaksis),
  addSaldo: (state, transaksi) => state.transaksis.push(transaksi),
  editSaldo(state, nSaldo){
    const oldSaldo = state.transaksis.find( transaksi => transaksi.id === nSaldo.id );
    if (oldSaldo) {
      // not creating a new object but modifying old object here
      Object.assign(oldSaldo, nSaldo)
    }
  },
  deleteSaldo: (state, id) => state.transaksis = state.transaksis.filter(transaksi => transaksi.id !== id)
}

// actions
export const actions = {
  async fetchTransaksis({ commit }){

    let id = store.getters['auth/user'].owner_id
    let role = store.getters['auth/user'].tipe
    let data = []
    if(role == 'Admin'){
      data =  (await axios.get('/api/transaksi')).data
    }
    if(role == 'Produsen'){
      data =  (await axios.get('/api/produsen/transaksi/'+id)).data
    }
    if(role == 'Pedagang'){
      data =  (await axios.get('/api/pedagang/transaksi/'+id)).data
    }
    commit('setTransaksi',data)
  }
}

import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {
  pedagangs: [
  ],

}

// getters
export const getters = {
  pedagangs: state => state.pedagangs,
}

// mutations
export const mutations = {
  setPedagangs: (state, pedagangs) => (state.pedagangs = pedagangs),
  addPedagang: (state, pedagang) => state.pedagangs.push(pedagang),
  editPedagang(state, nPedagang){
    const oldPedagang = state.pedagangs.find( pedagang => pedagang.id === nPedagang.id );
    if (oldPedagang) {
      // not creating a new object but modifying old object here
      Object.assign(oldPedagang, nPedagang)
    }
  },
  deletePedagang: (state, id) => state.pedagangs = state.pedagangs.filter(pedagang => pedagang.id !== id)
}

// actions
export const actions = {
  async fetchPedagangs({ commit }){
    const { data } = await axios.get('/api/pedagang')
    commit('setPedagangs',data)
  }
}

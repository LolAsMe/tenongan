import Vue from 'vue'
import { library, config } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {
  faTimesCircle
} from '@fortawesome/free-regular-svg-icons'

import {
  faUser, faLock, faSignOutAlt, faCog,faAddressBook
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub
} from '@fortawesome/free-brands-svg-icons'

config.autoAddCss = false

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faTimesCircle
)

Vue.component('Fa', FontAwesomeIcon)

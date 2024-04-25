import Vue from 'vue'
import FeatherIcon from '@core/components/feather-icon/FeatherIcon.vue'

Vue.component(FeatherIcon.name, FeatherIcon)

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon)
import { library } from '@fortawesome/fontawesome-svg-core'
//import { brand_icon } from '@fortawesome/free-brands-svg-icons'
//import { faCircleQuestion } from '@fortawesome/free-regular-svg-icons'
import { faFacebook, faTelegram, faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import { 
    faHouse, 
    faUser,
    faUserGraduate,
    faUsers, 
    faEye, 
    faUserShield, 
    faRightToBracket, 
    faTrash,
    faPencil,
    faPowerOff,
    faShare,
    faListCheck,
    faChildren,
    faSpellCheck,
    faBuildingUser,
    faGear,
    faDollarSign,
    faCircleCheck,
    faCheck,
    faXmark,
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faFacebook,
    faTelegram,
    faWhatsapp,
    faHouse, 
    faUser,
    faUserGraduate,
    faUsers, 
    faEye, 
    faUserShield, 
    faRightToBracket, 
    faTrash,
    faPencil,
    faPowerOff,
    faShare,
    faListCheck,
    faChildren,
    faSpellCheck,
    faBuildingUser,
    faGear,
    faDollarSign,
    faCircleCheck,
    faCheck,
    faXmark,
)
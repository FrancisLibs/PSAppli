/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.css";

// start the Stimulus application
import "./bootstrap";

import "./tools";

import { WorkorderIndex } from "./JS/WorkorderIndex";
new WorkorderIndex(document.querySelector(".js-filter"));

// import { PartIndex } from "./JS/PartIndex";
// new PartIndex(document.querySelector(".js-filter"));

// import { MachineIndex } from "./JS/MachineIndex";
// new MachineIndex(document.querySelector(".machine-js-filter"));

// import { PreventiveIndex } from "./JS/PreventiveIndex";
// new PreventiveIndex(document.querySelector(".preventive-js-filter"));

// import { ProviderIndex } from "./JS/ProviderIndex";
// new ProviderIndex(document.querySelector(".provider-js-filter"));

// import { DeliveryNoteIndex } from "./JS/DeliveryNoteIndex";
// new DeliveryNoteIndex(document.querySelector(".deliveryNote-js-filter"));

// import { OnCallIndex } from "./JS/OnCallIndex";
// new OnCallIndex(document.querySelector(".onCall-js-filter"));
const Ziggy = {"url":"http:\/\/mobile.test","port":null,"defaults":[],"routes":{"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"]},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"]},"debugbar.telescope":{"uri":"_debugbar\/telescope\/{id}","methods":["GET","HEAD"]},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"]},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"]},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"]},"horizon.stats.index":{"uri":"horizon\/api\/stats","methods":["GET","HEAD"]},"horizon.workload.index":{"uri":"horizon\/api\/workload","methods":["GET","HEAD"]},"horizon.masters.index":{"uri":"horizon\/api\/masters","methods":["GET","HEAD"]},"horizon.monitoring.index":{"uri":"horizon\/api\/monitoring","methods":["GET","HEAD"]},"horizon.monitoring.store":{"uri":"horizon\/api\/monitoring","methods":["POST"]},"horizon.monitoring-tag.paginate":{"uri":"horizon\/api\/monitoring\/{tag}","methods":["GET","HEAD"]},"horizon.monitoring-tag.destroy":{"uri":"horizon\/api\/monitoring\/{tag}","methods":["DELETE"]},"horizon.jobs-metrics.index":{"uri":"horizon\/api\/metrics\/jobs","methods":["GET","HEAD"]},"horizon.jobs-metrics.show":{"uri":"horizon\/api\/metrics\/jobs\/{id}","methods":["GET","HEAD"]},"horizon.queues-metrics.index":{"uri":"horizon\/api\/metrics\/queues","methods":["GET","HEAD"]},"horizon.queues-metrics.show":{"uri":"horizon\/api\/metrics\/queues\/{id}","methods":["GET","HEAD"]},"horizon.jobs-batches.index":{"uri":"horizon\/api\/batches","methods":["GET","HEAD"]},"horizon.jobs-batches.show":{"uri":"horizon\/api\/batches\/{id}","methods":["GET","HEAD"]},"horizon.jobs-batches.retry":{"uri":"horizon\/api\/batches\/retry\/{id}","methods":["POST"]},"horizon.pending-jobs.index":{"uri":"horizon\/api\/jobs\/pending","methods":["GET","HEAD"]},"horizon.completed-jobs.index":{"uri":"horizon\/api\/jobs\/completed","methods":["GET","HEAD"]},"horizon.failed-jobs.index":{"uri":"horizon\/api\/jobs\/failed","methods":["GET","HEAD"]},"horizon.failed-jobs.show":{"uri":"horizon\/api\/jobs\/failed\/{id}","methods":["GET","HEAD"]},"horizon.retry-jobs.show":{"uri":"horizon\/api\/jobs\/retry\/{id}","methods":["POST"]},"horizon.jobs.show":{"uri":"horizon\/api\/jobs\/{id}","methods":["GET","HEAD"]},"horizon.index":{"uri":"horizon\/{view?}","methods":["GET","HEAD"]},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"]},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"]},"current-user.destroy":{"uri":"user","methods":["DELETE"]},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"]},"api-tokens.index":{"uri":"user\/api-tokens","methods":["GET","HEAD"]},"api-tokens.store":{"uri":"user\/api-tokens","methods":["POST"]},"api-tokens.update":{"uri":"user\/api-tokens\/{token}","methods":["PUT"]},"api-tokens.destroy":{"uri":"user\/api-tokens\/{token}","methods":["DELETE"]},"user.home":{"uri":"\/","methods":["GET","HEAD"],"domain":"mobile.test"},"dashboard":{"uri":"\/","methods":["GET","HEAD"],"domain":"team.mobile.test"},"login":{"uri":"login","methods":["GET","HEAD"],"domain":"team.mobile.test"},"logout":{"uri":"logout","methods":["POST"],"domain":"team.mobile.test"},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"],"domain":"team.mobile.test"},"password.email":{"uri":"forgot-password","methods":["POST"],"domain":"team.mobile.test"},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"domain":"team.mobile.test"},"password.update":{"uri":"reset-password","methods":["POST"],"domain":"team.mobile.test"},"register":{"uri":"register","methods":["GET","HEAD"],"domain":"team.mobile.test"},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"],"domain":"team.mobile.test"},"user-password.update":{"uri":"user\/password","methods":["PUT"],"domain":"team.mobile.test"},"password.confirm":{"uri":"user\/confirm-password","methods":["GET","HEAD"],"domain":"team.mobile.test"},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"],"domain":"team.mobile.test"},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"],"domain":"team.mobile.test"},"user.ziggy":{"uri":"api\/routes","methods":["GET","HEAD"]},"user.dashboard":{"uri":"dashboard","methods":["GET","HEAD"],"domain":"my.mobile.test"},"user.ad.create":{"uri":"ads\/sell","methods":["GET","HEAD"],"domain":"my.mobile.test"},"user.ad.step_phone_model_variant":{"uri":"ads\/sell\/{phone_brand}\/{phone_model}","methods":["GET","HEAD"],"domain":"my.mobile.test","bindings":{"brand":"name","model":"name"}},"user.ad.step_phone_model":{"uri":"ads\/sell\/{phone_brand}","methods":["GET","HEAD"],"domain":"my.mobile.test","bindings":{"brand":"name"}},"user.ad.step_store_variant":{"uri":"ads\/sell\/store\/variant","methods":["POST"],"domain":"my.mobile.test"},"user.user.home":{"uri":"\/","methods":["GET","HEAD"],"domain":"my.mobile.test"},"user.login":{"uri":"login","methods":["GET","HEAD"],"domain":"my.mobile.test"},"user.logout":{"uri":"logout","methods":["POST"],"domain":"my.mobile.test"},"user.auth":{"uri":"auth","methods":["POST"],"domain":"my.mobile.test"},"user.verify":{"uri":"auth\/validate","methods":["POST"],"domain":"my.mobile.test"}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };
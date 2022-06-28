
// SET HEIGHT OF .parent_absolute (because of child position-absolute)
const set_parent_absolute_height = () => {
    document.querySelectorAll(".parent_absolute").forEach(element => {
        let div_height = 0;

        for(let child of element.children) {
            div_height += child.clientHeight;
        }
        element.style.height = div_height+"px";
    });
}
set_parent_absolute_height();

// AND EVENT RESIZE
window.addEventListener("resize", () => {
    set_parent_absolute_height();
})


// ADD ALERT TO #btn_action
const add_alert_btn_action = () => {
    if(document.getElementById("btn_action")) {
        document.getElementById("btn_action").addEventListener("click", () => {
            alert("Merci pour votre visite. \n\nCependant les logements ne seront disponibles qu'à partir de 2033. Alors n'hésitez pas à noter la date dans votre agenda !  \ud83d\ude00");
        })
    }
}
add_alert_btn_action();


// BTN SCROLL TO THE TOP
const scroll_top = () => {
    // create button
    if(!document.getElementById("scroll_top")) {
        let btn = document.createElement("button");
        btn.id = "scroll_top";
        btn.classList.add("position-fixed", "bg_orange", "txt_green_light", "border-0", "rounded", "m-4");
        btn.style.right = "0";
        btn.style.bottom = document.querySelector("footer").clientHeight+"px";
        btn.style.width = "40px";
        btn.style.height = "40px";
        btn.style.fontSize = "1.5em";
        btn.innerHTML = "&#9650;";
        document.querySelector(".container-fluid").append(btn);
    }
    let btn_scroll_top = document.getElementById("scroll_top");

    // hide button if position of scrollY < height of window & scroll event
    btn_scroll_top.hidden = (window.scrollY < (window.innerHeight || document.documentElement.clientHeight));
    window.addEventListener("scroll", () => {
        btn_scroll_top.hidden = (window.scrollY < (window.innerHeight || document.documentElement.clientHeight));
    })

    // opacity adjustment depending on window size (overlay) and mouseover / mouseout
    let window_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    let btn_opacity = window_width < 768 ? 0.3 : 0.6;
    btn_scroll_top.style.opacity = btn_opacity;

    window.addEventListener("resize", () => {
        window_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        btn_opacity = window_width < 768 ? 0.3 : 0.6;
        btn_scroll_top.style.opacity = btn_opacity;
    })

    btn_scroll_top.addEventListener("mouseover", (btn) => {
        btn.target.style.opacity = 1;
    })
    btn_scroll_top.addEventListener("mouseout", (btn) => {
        btn.target.style.opacity = btn_opacity;
    })

    // scrollTo the top when button clicked
    btn_scroll_top.addEventListener("click", (btn) => {
        window.scrollTo(0, 0);
        btn.target.style.opacity = btn_opacity;
    })
}
scroll_top();


// DISPLAY FILE NAME WHEN SELECTED (#form_logement)
const display_file_name = () => {
    document.querySelectorAll("input[type='file']").forEach(input_file => {
        input_file.addEventListener("change", () => {
            if(input_file.files.length === 1) {
                input_file.parentElement.querySelector("label").innerHTML = "&#10004; " + input_file.files[0].name;
                input_file.parentElement.querySelector("label").classList.remove("text-secondary");
            }
            else {
                input_file.parentElement.querySelector("label").innerHTML = "Sélectionner une photo";
            }
        })
    })
}
display_file_name();


// REMOVE #success_insert MESSAGE AFTER 5"
const remove_success_insert_msg = () => {
    if(document.querySelector("#form_logement")) {
        setTimeout(() => {
            if(document.querySelector("#success_insert")) {
                document.querySelector("#success_insert").remove();
            }
        }, 5000);
    }
}
remove_success_insert_msg();


// ************ JQUERY (have to use it for bootstrap collapse event) ************
$(document).ready(function() {

    // SET DISPLAY OF COLLAPSE BTN (#form_logement)
    const set_display_btn_collapse = () => {
        // actions
        const shown_action = () => {
            $("[data-target='#form_logement'].close").css({"display" : "inline"});
            $("[data-target='#form_logement']:not(.close):not([type='reset'])").css({"display" : "none"});
    
            $("[data-target='#form_logement']:not([type='reset'])").parent().removeClass("text-center").addClass("text-right");
        }
        const hidden_action = () => {
            $("[data-target='#form_logement'].close").css({"display" : "none"});
            $("[data-target='#form_logement']:not(.close):not([type='reset'])").css({"display" : "inline"});
    
            $("[data-target='#form_logement']:not([type='reset'])").parent().removeClass("text-right").addClass("text-center");
        
        }

        // if shown
        if($("#form_logement").hasClass("show")) { shown_action() }
        else { hidden_action() };

        // events
        $("#form_logement").on("show.bs.collapse", () => { shown_action() });
        $("#form_logement").on("hidden.bs.collapse", () => { hidden_action() });
    }
    set_display_btn_collapse();


    // REMOVE ERRORS WHEN FORM IS HIDDEN
    const remove_form_errors = () => {
        $("#form_logement").on("hidden.bs.collapse", () => {
            $("#form_logement .error_msg").each((i, error_msg) => {
                if(error_msg.parentElement.querySelector(".border_orange")) {
                    error_msg.parentElement.querySelector(".border_orange").classList.remove("border", "border_orange", "rounded");
                }
                if(error_msg.parentElement.querySelector(".bg-transparent")) {
                    error_msg.parentElement.querySelector(".bg-transparent").classList.add("border-0");
                }
                error_msg.remove();
            })
        })
    }
    remove_form_errors();
})

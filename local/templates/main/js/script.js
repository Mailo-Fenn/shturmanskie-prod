$(".category-slider__slick").slick({
  infinite: true,
  arrows: false,
  dots: true,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 1450,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
      },
    },
    {
      breakpoint: 970,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
      },
    },
    {
      breakpoint: 760,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        infinite: false,
        variableWidth: true,
      },
    },
  ],
});

$(".category-mobslider__slick").slick({
  infinite: true,
  arrows: false,
  dots: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  centerMode: false,
  infinite: false,
  variableWidth: true,
});

$(".news-slick").slick({
  infinite: true,
  arrows: false,
  dots: true,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 1,
  variableWidth: true,
  infinite: false,
});

$(".menu-watches__slick").slick({
  infinite: true,
  arrows: false,
  dots: true,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 2,
  variableWidth: true,
  infinite: false,

  responsive: [
    {
      breakpoint: 1450,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 970,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
  ],
});

/*$(".other-slider__slick").slick({
  infinite: true,
  arrows: false,
  dots: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  centerMode: false,
  infinite: false,
  variableWidth: true,
});*/

$(".other-slider__slick").slick({
  infinite: true,
  arrows: false,
  dots: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1450,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
      },
    },
    {
      breakpoint: 970,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
      },
    },
    {
      breakpoint: 760,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        infinite: false,
        variableWidth: true,
      },
    },
  ],
});

$(".product-info__slider").slick({
  infinite: true,
  arrows: false,
  dots: false,
  autoplay: true,
  autoplaySpeed: 2000,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
});

if (document.querySelector(".engravings-form form"))
  document
    .querySelector(".engravings-form form")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      document.querySelector(".loader").setAttribute("style", "");

      fetch("/local/scripts/engravings.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          fname: document.querySelector('form input[name="fname"]').value,
          lname: document.querySelector('form input[name="lname"]').value,
          email: document.querySelector('form input[name="email"]').value,
          phone: document.querySelector('form input[name="phone"]').value,
          message: document.querySelector('form textarea[name="message"]')
            .value,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          document
            .querySelector(".loader")
            .setAttribute("style", "display: none;");
          document.querySelector(".form-result").setAttribute("style", "");
        })
        .catch((error) => {
          document
            .querySelector(".loader")
            .setAttribute("style", "display: none;");
          document.querySelector(".form-result").setAttribute("style", "");
        });
    });

document.querySelector("footer form").addEventListener("submit", function (e) {
  e.preventDefault();

  document.querySelectorAll("footer .form-resp").forEach((item) => {
    item.setAttribute("style", "display: none");
  });

  document.querySelector(".loader").setAttribute("style", "");

  fetch("/local/scripts/subscribe.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      email: document.querySelector('form input[name="email"]').value,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Сетевая ошибка");
      }
      return response.text();
    })
    .then((data) => {
      document.querySelector(".loader").setAttribute("style", "display: none;");

      if (data == "error") {
        document
          .querySelector("footer .error.form-resp")
          .setAttribute("style", "");
      } else {
        document
          .querySelector("footer .good.form-resp")
          .setAttribute("style", "");
      }
      document.querySelector('form input[name="email"]').value = "";
    })
    .catch((error) => console.error("Ошибка:", error));
});

document.querySelectorAll(".with-arrow").forEach((item) => {
  item.onclick = () => {
    const target_tab = item.getAttribute("item");
    document.querySelector(`#${target_tab}`).classList.add("active");
    return false;
  };
});

document.querySelectorAll(".sub-tab__back").forEach((item) => {
  item.onclick = () => {
    document
      .querySelectorAll(".sub-tab")
      .forEach((hide) => hide.classList.remove("active"));
  };
});

if (document.querySelector(".header-right__svg.c3"))
  document.querySelector(".header-right__svg.c3").onclick = () => {
    document.querySelector(".search").classList.add("active");
  };

if (document.querySelector(".search-close img"))
  document.querySelector(".search-close img").onclick = () => {
    document.querySelector(".search").classList.remove("active");
  };

document.querySelectorAll(".header-popup").forEach((item) => {
  item.onclick = () => {
    if (item.getAttribute("item")) {
      document.querySelector(".header").classList.toggle("active");

      const target_item = document.querySelector(
        `#${item.getAttribute("item")}`
      );
      const target_status = target_item.classList.contains("active");

      document
        .querySelectorAll(".menu")
        .forEach((hide) => hide.classList.remove("active"));

      if (!target_status) {
        document
          .querySelector(`#${item.getAttribute("item")}`)
          .classList.add("active");

        document.querySelectorAll(".hlist-menu li").forEach((itemClose) => {
          itemClose.classList.add("deactive");
        });

        item.parentNode.classList.remove("deactive");
      } else {
        document.querySelectorAll(".hlist-menu li").forEach((itemClose) => {
          itemClose.classList.remove("deactive");
        });
      }

      if (item.getAttribute("item") == "menu_03") {
        document.querySelector(".mobile-menu").classList.toggle("active");
        if (target_item.classList.contains("active")) {
          document.querySelector("body").classList.add("overflow");
          document
            .querySelector(".header-popup.open")
            .setAttribute("style", "display: none");
          document
            .querySelector(".header-popup.close")
            .setAttribute("style", "display: block");
        } else {
          document.querySelector("body").classList.remove("overflow");
          document
            .querySelector(".header-popup.open")
            .setAttribute("style", "display: block");
          document
            .querySelector(".header-popup.close")
            .setAttribute("style", "display: none");
        }
      }

      return false;
    }
  };
});

document
  .querySelectorAll(".product-info__notification-item")
  .forEach((item) => {
    item.onclick = () => {
      const popup_item = item.querySelector(
        ".product-info__notification-item__popup"
      );

      document
        .querySelectorAll(".product-info__notification-item__popup")
        .forEach((i) => {
          if (i != popup_item) i.classList.remove("active");
        });

      popup_item.classList.toggle("active");
    };
  });

document.querySelectorAll(".footer-title").forEach((item) => {
  item.onclick = () => {
    item.parentNode.classList.toggle("active");
  };
});

//---------------------------------------

if (typeof slider !== "undefined") {
    let autoplay = true;
    let target_slide = 0;
    const slide_count = slider.length;
    const videoWrapper = document.querySelector(".slider-banner .slider-video");
    const video = document.querySelector(".slider-banner .slider-video video");

    // if (slider[target_slide].video) {
    //     video.play();
    // }

    const SetSlide = (index = 0) => {
        target_slide = index;
        const next_slide = target_slide + 1 >= slide_count ? 0 : target_slide + 1;
        
        SetTargetLine();

        document.querySelector(".slider-banner .sticker").innerHTML = slider[target_slide].sticker;
        document.querySelector(".slider-banner .title").innerHTML = slider[target_slide].title;
        document.querySelector(".slider-banner .btn").setAttribute("href", slider[target_slide].link);
        document.querySelector(".slider-banner").setAttribute("style", `background-image: url('${slider[target_slide].background}');`);

        if (slider[target_slide].video) {
            document.querySelector(".slider-banner-play img").setAttribute("style", "");

            video.setAttribute("src", slider[target_slide].video);
            video.setAttribute("poster", slider[target_slide].background);

            video.play();
            
            videoWrapper.setAttribute("style", "display: block;");
            
            video.onended = function () {
                autoplay = true;
                SetSlide(next_slide);
            };
        } else {
            document.querySelector(".slider-banner-play img").setAttribute("style", "display: none;");
            video.pause();
            videoWrapper.setAttribute("style", "display: none;");
            
            if (autoplay) {
                setTimeout(() => {
                    SetSlide(next_slide);
                }, 5000);
            }
        }
    };

    document.querySelector(".slider-banner-play img").onclick = () => {
        if(video){
            if (video.paused) {
                video.play();
                document.querySelector(".slider-banner-play img").setAttribute("src", "/images/stop.svg");
            } else {
                video.pause();
                document
                .querySelector(".slider-banner-play img")
                .setAttribute("src", "/images/play.svg");
            }
        }
    };

    const SetTargetLine = () => {
        document.querySelectorAll(".slider-banner-navigate>div").forEach((item, index) => {
            if (target_slide == index){
                item.classList.add("active");
            }else{
                item.classList.remove("active");
            }
        });
    };

    document.querySelectorAll(".slider-banner-navigate>div").forEach((item, index) => {
        item.onclick = () => {
            autoplay = false;
            SetSlide(index);
        };
    });

    SetSlide(0)
}

//------------------------------------------





document.addEventListener("click", function (e) {
  const menu = document.querySelectorAll(".menu");

  menu.forEach(function (m) {
    if (
      m.classList.contains("active") &&
      !m.contains(e.target) &&
      !e.target.closest(".header-popup")
    ) {
      m.classList.remove("active");

      document
        .querySelectorAll(".header li")
        .forEach((item) => item.classList.remove("deactive"));

      document.querySelector(".header").classList.toggle("active");
    }
  });

  document.querySelectorAll(".mobile-menu.active").forEach(function (m) {
    if (
      !e.target.closest(".mobile-menu>div") &&
      !e.target.closest(".header-popup")
    ) {
      m.classList.remove("active");

      document.querySelector(".header").classList.toggle("active");

      document
        .querySelector(".header-popup.open")
        .setAttribute("style", "display: block");
      document
        .querySelector(".header-popup.close")
        .setAttribute("style", "display: none");
    }
  });
});

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" || e.key === "Esc" || e.keyCode === 27) {
    document.querySelectorAll(".menu.active").forEach((item) => {
      item.classList.remove("active");
    });
  }
});

//--------------------------------

let zoom = 8;
let targetZoom = 12;

async function initMap() {
  if (typeof ymaps3 !== "undefined" && ymaps3 && ymaps3.YMap) {
    await ymaps3.ready;

    console.log('mapdots');

    const map = new ymaps3.YMap(document.getElementById("app"), {
      location: {
        center: [
          Number(MapDots[0].COORDINATES[1]),
          Number(MapDots[0].COORDINATES[0]),
        ],
        zoom: zoom,
      },
    });

    map.addChild(new ymaps3.YMapDefaultSchemeLayer());
    map.addChild(new ymaps3.YMapDefaultFeaturesLayer());

    MapDots.forEach((item) => {
      const content = document.createElement("div");
      content.innerHTML = `<span>${item.ADRESS}</span>`;

      const marker = new ymaps3.YMapMarker(
        {
          coordinates: [
            Number(item.COORDINATES[1]),
            Number(item.COORDINATES[0]),
          ],
          draggable: false,
        },
        content
      );

      map.addChild(marker);
      content.classList.add("ymarker");

      content.onclick = () => {};
    });

    document.querySelectorAll(".where-map__content-list li").forEach((item) => {
      item.onclick = () => {
        map.setLocation({
          center: [
            Number(item.getAttribute("let")),
            Number(item.getAttribute("len")),
          ],
          duration: 200,
          zoom: targetZoom,
        });

        document
          .querySelector(".where-map__content-list ul")
          .setAttribute("style", "");
      };
    });

    if (window.innerWidth < 970) {
      if (document.querySelector(".where-map__content-list input"))
        document.querySelector(".where-map__content-list input").onclick =
          () => {
            document
              .querySelector(".where-map__content-list ul")
              .setAttribute("style", "display: block;");
          };
    }

    document
      .querySelector(".where-map__content-list input")
      .addEventListener("input", function (event) {
        let isActive = false;

        document
          .querySelectorAll(".where-map__content-list li")
          .forEach((item) => {
            if (
              item.innerHTML
                .toLowerCase()
                .includes(event.target.value.toLowerCase())
            ) {
              isActive = true;
              item.setAttribute("style", "");
            } else {
              item.setAttribute("style", "display: none;");
            }
          });

        // if (isActive && event.target.value) {
        //   document
        //     .querySelector(".where-map__content-list ul")
        //     .setAttribute("style", "display: block;");
        // } else {
        //   document
        //     .querySelector(".where-map__content-list ul")
        //     .setAttribute("style", "");
        // }
      });
  }
}

initMap();

document.querySelectorAll(".password-format").forEach((item) => {
  item.onclick = () => {
    const input = item.parentNode.querySelector("input");
    if (input.getAttribute("type") == "password") {
      input.setAttribute("type", "text");
    } else {
      input.setAttribute("type", "password");
    }
  };
});

const newsSubscribe = document.querySelector("#news-subscribe");
if (newsSubscribe)
  newsSubscribe.addEventListener("change", function (e) {
    document.querySelector(".loader").setAttribute("style", "");

    fetch(
      `/local/scripts/newsletter.php?NEWSLETTER=${Number(e.target.checked)}`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
      }
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Сетевая ошибка");
        }
        return response.text();
      })
      .then((data) => {
        document
          .querySelector(".loader")
          .setAttribute("style", "display: none;");

        console.log(data);
      })
      .catch((error) => {
        document
          .querySelector(".loader")
          .setAttribute("style", "display: none;");

        alert("Ошибка");
      });
  });

const newProducts = document.querySelector("#new-products");
if (newProducts)
  newProducts.addEventListener("change", function (e) {
    document.querySelector(".loader").setAttribute("style", "");

    fetch(
      `/local/scripts/newproducts.php?NEWPRODUCTS=${Number(e.target.checked)}`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
      }
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Сетевая ошибка");
        }
        return response.text();
      })
      .then((data) => {
        document
          .querySelector(".loader")
          .setAttribute("style", "display: none;");

        console.log(data);
      })
      .catch((error) => {
        document
          .querySelector(".loader")
          .setAttribute("style", "display: none;");

        alert("Ошибка");
      });
  });

const updateUserInfo = document.querySelector("#update-userInfo");
if (updateUserInfo) {
  let isUpdatOpen = false;
  updateUserInfo.addEventListener("submit", function (e) {
    if (!isUpdatOpen) {
      e.preventDefault();
      updateUserInfo.classList.add("active");
      isUpdatOpen = true;

      updateUserInfo
        .querySelector(".info")
        .setAttribute("style", "display: none");
      updateUserInfo.querySelector(".form").setAttribute("style", "");

      updateUserInfo.querySelectorAll("input").forEach((item) => {
        item.setAttribute("required", "");
      });

      updateUserInfo.querySelector("button").innerHTML = updateUserInfo
        .querySelector("button")
        .getAttribute("save");
    }
  });
}

document.querySelectorAll(".form-addresses:not(.new)").forEach((item) => {
  let isUpdatOpen = false;
  item.addEventListener("submit", function (e) {
    if (!isUpdatOpen) {
      e.preventDefault();
      item.classList.add("active");
      isUpdatOpen = true;

      item.querySelector(".info").setAttribute("style", "display: none");
      item.querySelector(".form").setAttribute("style", "");

      item.querySelectorAll("input").forEach((item) => {
        item.setAttribute("required", "");
      });

      item.querySelector("button").innerHTML = item
        .querySelector("button")
        .getAttribute("save");
    }
  });
});

const filterOpener = document.querySelector(".c2>.catalog-list__filter-item");
if (filterOpener) {
  filterOpener.onclick = () => {
    document
      .querySelector(".catalog-list__filter-popup")
      .classList.toggle("active");
  };
}

// Вешаем обработчик на все кнопки "лайк" на карточках товаров
document
  .querySelectorAll(".catalog-list__item-image-like")
  .forEach(function (likeBtn) {
    likeBtn.addEventListener("click", function (e) {
      e.preventDefault();

      let itemId = likeBtn.getAttribute("data-id");

      // Отправляем ajax-запрос
      fetch("/local/scripts/favorite.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + encodeURIComponent(itemId),
      })
        .then((response) => response.json())
        .then((data) => {
          // Ожидаем, что сервер вернет {status: "added"} или {status: "removed"}
          if (data.status === "added") {
            likeBtn.classList.add("active");
          } else if (data.status === "removed") {
            likeBtn.classList.remove("active");
          }
        })
        .catch((error) => {
          // Можно добавить обработку ошибок
          console.error("Ошибка при добавлении в избранное:", error);
        });
    });
  });

document.getElementById("filter-sort")?.addEventListener("click", function () {
  // Получаем параметры из URL
  const params = new URLSearchParams(window.location.search);
  const fmprice = params.get("fmprice");

  if (fmprice !== null) {
    params.delete("fmprice");
  } else {
    params.set("fmprice", "1");
  }

  const newUrl =
    window.location.pathname +
    (params.toString() ? "?" + params.toString() : "");
  window.location.href = newUrl;
});

document
  .getElementById("filter-on-stock")
  ?.addEventListener("click", function () {
    const params = new URLSearchParams(window.location.search);
    const stock = params.get("stock");

    if (stock !== null) {
      params.delete("stock");
    } else {
      params.set("stock", "1");
    }

    const newUrl =
      window.location.pathname +
      (params.toString() ? "?" + params.toString() : "");
    window.location.href = newUrl;
  });

document
  .querySelector("#collection-select")
  ?.addEventListener("change", function () {
    const collectionSelect = document.querySelector(".model-list select");
    const event = new Event("change", { bubbles: true });

    collectionSelect.dispatchEvent(event);

    const modelBlock = document.querySelector(".model-list");
    const modelSelect = modelBlock.querySelector("select");

    modelSelect.innerHTML = `<option value="">${modelSelect.getAttribute(
      "all"
    )}</option>`;

    if (groupedCategories[this.value]) {
      modelBlock.style.display = "block";

      groupedCategories[this.value].forEach((item) => {
        modelSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
      });
    } else {
      modelBlock.style.display = "none";
    }
  });

if (document.querySelector("#collection-select")) {
  if (!groupedCategories[document.querySelector("#collection-select").value]) {
    document.querySelector(".model-list").style.display = "none";
  }
}

document.querySelectorAll(".cart-product__count input").forEach((item) => {
  item.addEventListener("change", function () {
    const itemId = item.getAttribute("data-id");
    const quantity = item.value;

    document.querySelector(".loader").setAttribute("style", "");

    fetch(`/local/scripts/cart.php?id=${itemId}&quantity=${quantity}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        document
          .querySelector(".loader")
          .setAttribute("style", "display: none;");

        location.reload();
      });
  });
});

document.querySelectorAll(".account-orders__header a").forEach((item) => {
  item.onclick = () => {
    document.querySelectorAll(".account-orders__header a").forEach((i) => {
      i.classList.remove("active");
    });
    item.classList.add("active");

    document.querySelectorAll(".account-orders__item").forEach((i) => {
      if (
        i.getAttribute("type") == item.getAttribute("id") ||
        item.getAttribute("id") == "ALL"
      ) {
        i.setAttribute("style", "");
      } else {
        i.setAttribute("style", "display: none;");
      }
    });
	
	document.querySelectorAll(".support_btns").forEach((i) => {
      if (
        i.getAttribute("type") == item.getAttribute("id") ||
        item.getAttribute("id") == "ALL"
      ) {
        i.setAttribute("style", "");
      } else {
        i.setAttribute("style", "display: none;");
      }
    });
  };
});

const countryInput = document.querySelector(".country-input");
const cityInput = document.querySelector(".city-input");

if (countryInput || cityInput) {
  let cityList = [];
  let countryList = [];

  fetch("/local/scripts/get_address.php", {
    method: "POST",
    headers: {},
  })
    .then((response) => response.json())
    .then((data) => {
      if (countryInput) {
        countryList = [...new Set(data.map((item) => item.country))];
      }
      if (cityInput) {
        cityList = data;
      }

      console.log(data);
    })
    .catch((error) => {
      console.log(error);
    });

  const SetAddressList = (list, data, input) => {
    data.forEach((item) => {
      const NodeItem = document.createElement("div");
      NodeItem.classList.add("country-list__item");
      NodeItem.innerHTML = item;
      NodeItem.onclick = () => {
        input.value = item;
        list.setAttribute("style", "display: none;");
      };
      list.appendChild(NodeItem);
    });

    if (data.length > 0) {
      list.setAttribute("style", "");
    } else {
      list.setAttribute("style", "display: none;");
    }
  };

  countryInput.addEventListener("input", function (e) {
    const InputWrapper = countryInput.parentNode.parentNode;
    const list = InputWrapper.querySelector(".address-input__list");

    if (e.target.value.length < 3) {
      list.innerHTML = "";
      list.setAttribute("style", "display: none;");
      return;
    }

    list.innerHTML = "";

    const filteredCountries = countryList.filter((country) =>
      country.toLowerCase().includes(e.target.value.toLowerCase())
    );

    SetAddressList(list, filteredCountries, countryInput);
  });

  cityInput.addEventListener("input", function (e) {
    const InputWrapper = cityInput.parentNode.parentNode;
    const list = InputWrapper.querySelector(".address-input__list");

    if (e.target.value.length < 3) {
      list.innerHTML = "";
      list.setAttribute("style", "display: none;");
      return;
    }

    list.innerHTML = "";

    let filteredCities = cityList.filter((city, index) => {
      const cityName = city.city;
      if (cityName) {
        return cityName.toLowerCase().includes(e.target.value.toLowerCase());
      }
      return false;
    });

    filteredCities = [...new Set(filteredCities.map((item) => item.city))];

    SetAddressList(list, filteredCities, cityInput);
  });
}

document.addEventListener("click", function (e) {
  const filterPopup = document.querySelector(
    ".catalog-list__filter-popup.active"
  );
  if (
    filterPopup &&
    !filterPopup.contains(e.target) &&
    !e.target.closest(".catalog-list__filter-search")
  ) {
    filterPopup.classList.remove("active");
  }
});



// Заявка на отмену заказа
var is_order_send = false;

$(document).ready(function () {
	
	$(".cancel_order").bind('click', function () {
		
		var obj = this;		
		
		if(!$(obj).hasClass('noactive')) {
		
			var order_id = $(this).attr('data-id');			

			if (confirm('Вы действительно хотите отменить заказ?')) {

				if (!is_order_send) {

					is_order_send = true;

					jQuery.post('/local/ajax/cancel_order.php?id=' + order_id, {}, function (data) {

						is_order_send = false;

						if (data == 'success') {

							$(obj).text('Заявка на отмену подана');
							$(obj).addClass('noactive');

						} else {

							alert(data);

						}

					});

				}

			}
		
		}

    });
	
});
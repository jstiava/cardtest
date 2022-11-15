<!-- 
Template Name: Dining Test 
-->

<?php get_header(); ?>

<div class="wrapper">
     <div id="content" class="content">
          <div id="dining_dashboard">
                <div id="control_panel">

                    <h6>Dining Hours & Events Dashboard, Dev 2.0</h6>

                    <div class="row space-between width-full">

                        <div class="row align-items">
                            <svg width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.4915 5.59192C14.2174 5.5936 11.9948 6.2695 10.1047 7.53416C8.21471 8.79882 6.74205 10.5955 5.87295 12.697C5.00384 14.7985 4.77732 17.1105 5.22201 19.3407C5.66671 21.5709 6.76264 23.6192 8.37129 25.2267C9.97993 26.8341 12.029 27.9285 14.2596 28.3716C16.4901 28.8146 18.802 28.5864 20.9028 27.7157C23.0037 26.8451 24.7992 25.3711 26.0625 23.4801C27.3258 21.5891 28 19.366 28 17.0919C27.9955 14.0418 26.7813 11.1181 24.6237 8.96216C22.4662 6.80623 19.5416 5.59417 16.4915 5.59192ZM16.4915 26.8882C14.5543 26.8865 12.6611 26.3106 11.0513 25.2331C9.4414 24.1556 8.18712 22.6251 7.44696 20.8349C6.70681 19.0447 6.51403 17.0753 6.89298 15.1755C7.27194 13.2758 8.20561 11.5311 9.57599 10.1619C10.9464 8.7927 12.6919 7.86054 14.592 7.48324C16.492 7.10593 18.4613 7.30043 20.2508 8.04214C22.0404 8.78385 23.5699 10.0395 24.6459 11.6503C25.722 13.2611 26.2963 15.1548 26.2963 17.0919C26.294 19.6908 25.26 22.1825 23.4215 24.0195C21.583 25.8564 19.0904 26.8882 16.4915 26.8882V26.8882Z" fill="#353535"/>
                                <path d="M22.4545 16.24H17.3434V11.9808C17.3434 11.7548 17.2536 11.5382 17.0938 11.3784C16.9341 11.2187 16.7174 11.1289 16.4915 11.1289C16.2656 11.1289 16.0489 11.2187 15.8891 11.3784C15.7294 11.5382 15.6396 11.7548 15.6396 11.9808V17.9437H22.4545C22.6804 17.9437 22.8971 17.854 23.0568 17.6942C23.2166 17.5345 23.3063 17.3178 23.3063 17.0919C23.3063 16.8659 23.2166 16.6493 23.0568 16.4895C22.8971 16.3298 22.6804 16.24 22.4545 16.24Z" fill="#353535"/>
                            </svg>
                            <input type="datetime-local" id="datetime">
                        </div>
                        
                        <div class="row align-items">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="35" viewBox="0 0 34 35" fill="none">
                                <path d="M21.9832 26.5542C21.0451 27.6122 19.8194 28.3745 18.4557 28.7482C17.9254 28.89 17.3789 28.9614 16.83 28.9607C15.1159 28.9324 13.4731 28.27 12.2188 27.1014C12.1676 27.0506 12.1066 27.0108 12.0395 26.9843C11.9724 26.9579 11.9006 26.9454 11.8286 26.9476C11.7565 26.9498 11.6856 26.9666 11.6202 26.9971C11.5549 27.0276 11.4964 27.071 11.4484 27.1248C11.4004 27.1786 11.3638 27.2416 11.3409 27.31C11.3181 27.3784 11.3093 27.4507 11.3153 27.5226C11.3213 27.5944 11.3418 27.6643 11.3757 27.728C11.4095 27.7917 11.456 27.8478 11.5122 27.8929C12.9657 29.2406 14.8693 29.9982 16.8513 30.0179C17.4827 30.0291 18.1129 29.9595 18.7266 29.8107C20.2922 29.3865 21.6983 28.5107 22.7694 27.2926C22.8542 27.187 22.8955 27.053 22.8848 26.9179C22.8741 26.7829 22.8122 26.6571 22.7118 26.5661C22.6113 26.4752 22.48 26.4261 22.3446 26.4288C22.2091 26.4315 22.0799 26.4859 21.9832 26.5807V26.5542Z" fill="#353535"/>
                                <path d="M26.1427 19.3504C26.0747 19.3346 26.0042 19.3324 25.9354 19.3439C25.8665 19.3554 25.8006 19.3804 25.7414 19.4174C25.6822 19.4544 25.6308 19.5027 25.5903 19.5596C25.5498 19.6165 25.5209 19.6807 25.5052 19.7488C25.0893 21.615 24.2616 23.3647 23.0827 24.87C23.0386 24.9244 23.0056 24.9869 22.9858 25.054C22.9659 25.1211 22.9594 25.1915 22.9668 25.2611C22.9743 25.3307 22.9953 25.3982 23.0289 25.4596C23.0625 25.5211 23.1078 25.5753 23.1624 25.6191C23.2559 25.6941 23.372 25.7353 23.4918 25.736C23.5695 25.7389 23.6468 25.7246 23.7184 25.6944C23.79 25.6641 23.8541 25.6184 23.9062 25.5607C25.1947 23.9315 26.1023 22.0346 26.5624 20.0091C26.5812 19.9382 26.585 19.8641 26.5738 19.7916C26.5625 19.7191 26.5363 19.6497 26.4969 19.5878C26.4574 19.5259 26.4056 19.4728 26.3447 19.432C26.2837 19.3911 26.215 19.3633 26.1427 19.3504Z" fill="#353535"/>
                                <path d="M23.4813 8.31628C22.6713 7.34648 21.6638 6.56055 20.5261 6.0109C19.3883 5.46125 18.1464 5.16053 16.8832 5.12878C16.4831 5.12919 16.0835 5.15938 15.6879 5.2191C10.3754 6.02128 6.5929 11.9447 7.0179 18.6969C7.11162 20.3212 7.46124 21.9205 8.05384 23.4357C8.09236 23.5355 8.16015 23.6214 8.2483 23.682C8.33646 23.7427 8.44089 23.7753 8.5479 23.7757C8.6135 23.7762 8.67854 23.7636 8.73915 23.7385C8.80455 23.7132 8.86429 23.6753 8.91496 23.6268C8.96562 23.5784 9.0062 23.5204 9.03435 23.4562C9.06249 23.392 9.07766 23.3229 9.07897 23.2528C9.08027 23.1827 9.0677 23.113 9.04196 23.0478C8.49519 21.6419 8.16905 20.16 8.07509 18.6544C7.68728 12.4441 11.0979 7.01472 15.8526 6.29222C16.1935 6.23868 16.5381 6.21204 16.8832 6.21253C17.9948 6.24338 19.0872 6.50985 20.0882 6.99431C21.0892 7.47876 21.9759 8.17018 22.6898 9.02285C24.5651 11.1107 25.8188 14.6807 25.7445 17.7141C25.7445 17.855 25.8004 17.9901 25.9001 18.0897C25.9997 18.1894 26.1348 18.2453 26.2757 18.2453C26.4166 18.2453 26.5517 18.1894 26.6514 18.0897C26.751 17.9901 26.807 17.855 26.807 17.7141C26.8867 14.4575 25.5001 10.5847 23.4813 8.31628Z" fill="#353535"/>
                                <path d="M23.492 20.5616C23.7893 20.3276 24.0338 20.0334 24.2096 19.6983C24.3854 19.3633 24.4884 18.9949 24.512 18.6172C24.7018 15.5796 23.7909 12.5752 21.9461 10.1544C21.3362 9.39868 20.5674 8.7865 19.6942 8.36139C18.821 7.93629 17.865 7.70868 16.8939 7.69475C16.5897 7.69356 16.286 7.71665 15.9855 7.76381C11.9267 8.38006 9.03141 13.0126 9.33422 18.2985C9.52016 21.2576 10.7208 24.0094 12.5536 25.6563C13.6787 26.722 15.1637 27.3251 16.7133 27.3457C17.21 27.3455 17.7046 27.2812 18.1848 27.1544C19.2199 26.8473 20.1692 26.3033 20.9576 25.5656C21.746 24.8279 22.3518 23.9168 22.727 22.9044C22.9957 22.2628 23.0369 21.5486 22.8439 20.8804C23.0784 20.8167 23.2985 20.7085 23.492 20.5616V20.5616ZM22.233 19.8551L22.1214 19.8232C22.0138 19.7865 21.8972 19.7853 21.7888 19.8198C21.6805 19.8543 21.586 19.9227 21.5194 20.0149C21.4528 20.1071 21.4175 20.2182 21.4188 20.3319C21.4201 20.4456 21.4578 20.5559 21.5264 20.6466C21.7167 20.9119 21.8365 21.2213 21.8746 21.5455C21.9127 21.8698 21.8679 22.1985 21.7442 22.5007C21.4296 23.3598 20.9199 24.1341 20.2553 24.7628C19.5906 25.3915 18.7891 25.8574 17.9139 26.1238C17.0987 26.3232 16.2463 26.3128 15.4362 26.0935C14.6261 25.8743 13.8848 25.4534 13.2814 24.8701C11.6505 23.3985 10.5773 20.9176 10.4073 18.2347C10.0939 13.4907 12.6227 9.34693 16.1502 8.80506C16.3964 8.76868 16.645 8.75092 16.8939 8.75193C17.7114 8.76451 18.5162 8.95718 19.2507 9.31621C19.9853 9.67524 20.6317 10.1918 21.1439 10.8291C22.8031 13.0419 23.6238 15.7714 23.4602 18.5322C23.4468 18.762 23.3851 18.9864 23.2788 19.1906C23.1726 19.3947 23.0244 19.5741 22.8439 19.7169C22.7576 19.7818 22.6585 19.8276 22.5532 19.8514C22.4479 19.8752 22.3388 19.8764 22.233 19.8551V19.8551Z" fill="#353535"/>
                                <path d="M16.782 10.5262C16.5792 10.5261 16.3767 10.5421 16.1764 10.5741C13.467 11.0203 11.512 14.3619 11.7351 18.1869C11.8626 20.3384 12.6701 22.3306 13.8973 23.4994C14.6164 24.2379 15.5974 24.6635 16.6279 24.6841C16.955 24.688 17.2809 24.6433 17.5948 24.5512C19.0132 24.1422 19.8845 23.2816 20.506 21.6612C20.5328 21.5351 20.5128 21.4035 20.4497 21.2911C20.3866 21.1786 20.2848 21.093 20.1632 21.05C20.0416 21.0071 19.9085 21.0099 19.7888 21.0578C19.6691 21.1058 19.571 21.1956 19.5126 21.3106C19.0185 22.6016 18.3757 23.2497 17.3026 23.5578C17.084 23.6244 16.8564 23.6566 16.6279 23.6534C15.8727 23.6326 15.1564 23.3137 14.6357 22.7662C13.5732 21.7675 12.9092 20.0356 12.7976 18.1391C12.6064 14.8506 14.1682 11.9978 16.3517 11.6419C16.9205 11.5825 17.495 11.674 18.0172 11.9072C18.5394 12.1403 18.9911 12.5069 19.3267 12.97C20.4914 14.5065 21.0765 16.4047 20.9789 18.3303C20.9789 18.4712 21.0348 18.6063 21.1345 18.706C21.2341 18.8056 21.3692 18.8616 21.5101 18.8616C21.651 18.8616 21.7861 18.8056 21.8858 18.706C21.9854 18.6063 22.0414 18.4712 22.0414 18.3303C22.1383 16.1533 21.467 14.0115 20.1448 12.2794C19.749 11.7565 19.242 11.328 18.6604 11.0248C18.0789 10.7217 17.4373 10.5514 16.782 10.5262V10.5262Z" fill="#353535"/>
                                <path d="M16.7504 14.1335C16.9544 14.1146 17.16 14.1426 17.3515 14.2154C17.543 14.2881 17.7153 14.4037 17.8554 14.5532C18.3145 15.0437 18.6704 15.6213 18.9022 16.2519C19.134 16.8824 19.2369 17.5531 19.2047 18.2241C19.2047 18.365 19.2607 18.5002 19.3603 18.5998C19.46 18.6994 19.5951 18.7554 19.736 18.7554C19.8724 18.7555 20.0037 18.7032 20.1026 18.6093C20.2015 18.5153 20.2604 18.3869 20.2672 18.2507C20.3052 17.4283 20.1765 16.6067 19.8889 15.8353C19.6013 15.0639 19.1608 14.3585 18.5938 13.7616C18.3382 13.5065 18.028 13.3127 17.6866 13.1949C17.3451 13.0771 16.9814 13.0384 16.6229 13.0816C14.9707 13.326 13.7541 15.4776 13.9082 17.8629C14.0091 19.4194 14.6572 20.8485 15.5657 21.5073C15.8879 21.7537 16.281 21.8897 16.6866 21.8951C16.83 21.8961 16.9729 21.8782 17.1116 21.8419C17.3863 21.7761 17.6411 21.6452 17.8547 21.4603C18.0683 21.2754 18.2343 21.0419 18.3388 20.7794C18.8701 19.5629 18.3388 17.6769 17.6163 16.3488C17.5459 16.2255 17.4293 16.1353 17.2923 16.0979C17.1553 16.0606 17.0091 16.0791 16.8858 16.1496C16.7626 16.22 16.6723 16.3366 16.6349 16.4736C16.5976 16.6106 16.6162 16.7568 16.6866 16.8801C17.3879 18.1444 17.6801 19.6426 17.3613 20.3757C17.3195 20.49 17.2485 20.5914 17.1553 20.6697C17.062 20.748 16.9499 20.8005 16.8301 20.8219C16.7142 20.8488 16.5937 20.8478 16.4783 20.8192C16.3629 20.7906 16.2559 20.7351 16.166 20.6573C15.5285 20.1951 15.0238 19.021 14.9494 17.8044C14.8272 15.9982 15.6719 14.2929 16.7504 14.1335Z" fill="#353535"/>
                                <path d="M10.306 24.9498C10.2355 24.8258 10.1187 24.7349 9.98122 24.697C9.84373 24.6592 9.69684 24.6775 9.57285 24.7479C9.44886 24.8184 9.35794 24.9352 9.32008 25.0727C9.28222 25.2102 9.30053 25.3571 9.37097 25.4811L9.97129 26.5807C10.0165 26.6656 10.0838 26.7366 10.1661 26.7861C10.2484 26.8357 10.3427 26.862 10.4388 26.8623C10.5284 26.8626 10.6165 26.8387 10.6938 26.7932C10.8166 26.7259 10.9079 26.6127 10.9477 26.4784C10.9875 26.3441 10.9726 26.1995 10.9063 26.0761L10.306 24.9498Z" fill="#353535"/>
                            </svg>
                            <select name="preferences" id="preferences">
                                <option>Allergens & Preferences</option>
                                <option>Simply Made</option>
                                <option>Top 9 Friendly</option>
                                <option>Avoid Tree Nuts</option>
                            </select>
                        </div>
                        
                        <div class="row align-items">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36" fill="none">
                                <path d="M16.8838 24.1135C16.9501 24.2005 17.0359 24.2708 17.1342 24.3188C17.2326 24.3668 17.3408 24.3911 17.4502 24.3899C17.559 24.3911 17.6665 24.3668 17.7641 24.3187C17.8617 24.2707 17.9467 24.2004 18.0121 24.1135C18.0121 24.1135 19.5029 22.1877 20.9529 19.8677C22.9466 16.6958 23.9571 14.2263 23.9571 12.586C23.98 11.7167 23.8286 10.8517 23.5118 10.0419C23.195 9.23215 22.7192 8.49403 22.1125 7.87111C21.5058 7.24819 20.7805 6.7531 19.9794 6.41505C19.1782 6.077 18.3175 5.90283 17.4479 5.90283C16.5784 5.90283 15.7176 6.077 14.9165 6.41505C14.1154 6.7531 13.39 7.24819 12.7833 7.87111C12.1766 8.49403 11.7009 9.23215 11.3841 10.0419C11.0673 10.8517 10.9159 11.7167 10.9388 12.586C10.9388 14.258 11.9493 16.7185 13.943 19.8994C15.4066 22.2285 16.8702 24.0954 16.8838 24.1135ZM17.4457 6.98084C18.9315 6.98323 20.3558 7.57454 21.4065 8.6252C22.4571 9.67585 23.0484 11.1001 23.0508 12.586C23.0508 14.0541 22.0857 16.3424 20.1825 19.3829C19.0271 21.2361 17.8535 22.8176 17.4638 23.3522C17.0605 22.8221 15.8914 21.2588 14.745 19.4101C12.8419 16.3741 11.8768 14.0768 11.8768 12.5769C11.8803 11.0985 12.4673 9.68132 13.5101 8.6334C14.553 7.58548 15.9673 6.99158 17.4457 6.98084V6.98084Z" fill="#353535"/>
                                <path d="M17.5 15.5587C18.1273 15.5587 18.7406 15.3726 19.2622 15.0241C19.7838 14.6756 20.1904 14.1802 20.4304 13.6006C20.6705 13.021 20.7333 12.3833 20.6109 11.768C20.4885 11.1527 20.1864 10.5875 19.7429 10.1439C19.2993 9.70033 18.7341 9.39824 18.1188 9.27585C17.5035 9.15347 16.8658 9.21628 16.2862 9.45635C15.7066 9.69642 15.2112 10.103 14.8627 10.6246C14.5142 11.1462 14.3281 11.7594 14.3281 12.3868C14.3281 13.228 14.6623 14.0348 15.2571 14.6296C15.852 15.2245 16.6588 15.5587 17.5 15.5587V15.5587ZM17.5 10.1212C17.9481 10.1212 18.3861 10.254 18.7587 10.503C19.1313 10.7519 19.4217 11.1058 19.5932 11.5198C19.7646 11.9338 19.8095 12.3893 19.7221 12.8288C19.6347 13.2683 19.4189 13.672 19.102 13.9888C18.7852 14.3057 18.3815 14.5215 17.942 14.6089C17.5025 14.6963 17.047 14.6514 16.633 14.4799C16.219 14.3085 15.8652 14.0181 15.6162 13.6455C15.3673 13.2729 15.2344 12.8349 15.2344 12.3868C15.2344 11.7859 15.4731 11.2096 15.898 10.7847C16.3228 10.3599 16.8991 10.1212 17.5 10.1212V10.1212Z" fill="#353535"/>
                                <path d="M30.0794 26.9555L26.7671 21.015C26.6436 20.743 26.4439 20.5127 26.1922 20.3518C25.9404 20.191 25.6475 20.1065 25.3488 20.1087H22.4307C22.3105 20.1087 22.1952 20.1565 22.1103 20.2415C22.0253 20.3264 21.9775 20.4417 21.9775 20.5619C21.9775 20.682 22.0253 20.7973 22.1103 20.8823C22.1952 20.9673 22.3105 21.015 22.4307 21.015H25.3488C25.4806 21.0162 25.609 21.0571 25.7173 21.1322C25.8255 21.2074 25.9087 21.3134 25.956 21.4364L29.2275 27.327V28.5142C29.2275 28.6837 29.1602 28.8462 29.0404 28.966C28.9206 29.0858 28.7581 29.1531 28.5886 29.1531H6.30395C6.1345 29.1531 5.97199 29.0858 5.85217 28.966C5.73235 28.8462 5.66504 28.6837 5.66504 28.5142V27.2953L8.8052 21.4047C8.85459 21.2871 8.93783 21.1868 9.04432 21.1166C9.15082 21.0465 9.27578 21.0095 9.40332 21.0105H12.4619C12.5821 21.0105 12.6973 20.9627 12.7823 20.8777C12.8673 20.7928 12.915 20.6775 12.915 20.5573C12.915 20.4372 12.8673 20.3219 12.7823 20.2369C12.6973 20.152 12.5821 20.1042 12.4619 20.1042H9.40332C9.10477 20.1 8.81157 20.1837 8.5602 20.3448C8.30884 20.5059 8.11039 20.7374 7.98957 21.0105L4.81316 26.9691C4.77784 27.0345 4.75916 27.1077 4.75879 27.182V28.5142C4.75879 28.924 4.92158 29.317 5.21135 29.6068C5.50113 29.8966 5.89414 30.0594 6.30395 30.0594H28.5886C28.9984 30.0594 29.3914 29.8966 29.6812 29.6068C29.971 29.317 30.1338 28.924 30.1338 28.5142V27.1548C30.1313 27.0851 30.1127 27.0169 30.0794 26.9555Z" fill="#353535"/>
                            </svg>
                            <select name="regions" id="regions">
                                <option>Select a Location</option>
                                <option>The South 40</option>
                                <option>Across the Danforth Campus</option>
                                <option>At the Village & Snow Way</option>
                                <option>Beside Tisch Park & Brookings</option>
                                <option>Medical Campus</option>
                                <option>Delmar Loop</option>
                                <option>Clayton</option>
                            </select>
                        </div>
                        
                        <button type="button" id="update_dashboard">Update</button>
                        
                    </div>

                    <div class="row">
                        <p id="currentposition"></p>
                    </div>

                    
                </div>

                <div id="dining_locations">
                    
                </div>
          </div>
     </div>
</div>

<?php get_footer(); ?>
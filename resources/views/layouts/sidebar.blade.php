<!-- Sidebar -->
<aside id="sidebar"
       class="transition-all duration-300 w-20 bg-white shadow-md flex flex-col py-6 relative items-center">

    <!-- Hamburger Button -->
    <button onclick="toggleSidebar()" class="absolute top-4 left-7 focus:outline-none z-10">
        <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="50" height="50" fill="url(#pattern0_284_981)"/>
<defs>
<pattern id="pattern0_284_981" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_284_981" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_284_981" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA2ElEQVR4nO3aQWrCUBSF4Udndp/3zLOC7MG26CrViU5TAhm3vAz0gd8HbuAgN5A/rQEAAAAAAADwOkk+k/wkuSVZ/PLXBteq+p6m6bBn6LNx0/sHO3eNPM/zR1U9DJ3eoe/rdobOYEM7Hdk1dFWd+g50a2097Em+1kPvhOS/gS9Vddz1MAQAAAAAeHPibHpe+ouzeW7BF2fznKHF2Yw49HajfdcRcXYZKRiLswAAAAAA+4mzEWczwMt+cTYvHVqczYhDbzdanI04uwxwj8VZAAAAAAAAgDaYX5XZAcBDuIxEAAAAAElFTkSuQmCC"/>
</defs>
</svg>
    </button>

<!-- Navigation Menu -->
    <nav class="flex flex-col space-y-2 w-full items-center mt-10">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
   class="w-full flex items-center justify-center py-3 relative hover:bg-gray-100">

            <div class="w-6 h-6">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="24" height="24" fill="url(#pattern0_284_982)"/>
            <defs>
                <pattern id="pattern0_284_982" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_284_982" transform="scale(0.0111111)"/>
                </pattern>
                <image id="image0_284_982" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
            </defs>
                </svg>

            </div>
        </a>

         {{-- Penerimaan --}}
    <a href="{{ route('penerimaan_barang.index') }}"
       class="w-full flex items-center justify-center py-3 relative 
       {{ request()->routeIs('penerimaan_barang.*') ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-100' }}">
        <div class="w-6 h-6">
            <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="50" height="50" fill="url(#pattern0_288_378)"/>
<defs>
<pattern id="pattern0_288_378" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_288_378" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_288_378" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAHN0lEQVR4nO1dWawURRQtUHGJu0TFBRFDcIsbmGhcweVDRKJkfhAdM1P3VPc8n/GBCbhOjCQuxAVNEIUE/RPELSYKYnCJCRqJGiOgBtG4iyiLIDuYm9dDhmdVv66epabm9UnuD6+6u+rM7epb954qhMiQIUOGDBkyZMiQHv2UUtcAeJWI/iai7wHcUcP9MlSjUCgcRkS3E9HXAPZoLL/PBRnsoJQaRkSPsPcaCK7YqnK53N/y9n0b5XK5PxFdDeBNALt7IXivKaWuc913LwDgCHRjZVJye9hbrsfQ0gBwOoAZADalJLhiu4MgGC58hVJqCICZAH4B8BcRPZ7L5QbUcs9yubw/gBwRfVAjufsYET0pPCX4eQDbNYN6Is09gyA4lojuBfBTPQmusvWlUulQ4QMADOZXmYi2xnjOViZNJISUcgQRPUdE/zaI4GoLhccerLMpvd0TwE1E9EkTyK22r3hhI9qA4Ir9kMvl9jPdF8CjTSZ4r0kpR4s2IHivKaXG6e4NYBAR7XJFNC/Rm8/o/0k4AMD0WgiuGBG9o3uGlPIihySz7SwUCqcIl7B8pbfxRwzAVMPfd3McrMtNANjikmxeuguXIKLfkhDM0wpPL3xNZ2fngUT0h2FAT+ueA+AFx179Zz6fP0i0KNHbqwmuBoBpBqI3sAdr2o90TDT37ZamEash4GEbgisIw/BkItphGFDJ8KyljsmeLVx+DHn+AvBr5N0z4wjuce0CA9HLdbErgAmOiZ4ufASAUTaxay6XG5Dwm9CIaeOfMAyHCk/Rj1dehoG9orsAwINNJpkjoYXFYvEM4TN4PraJXQEMqkfMnsA2cigqpTxLtAM4O8ZZMsNgp+muIaKXGjhFfMt5lzAMjxLthihRv0dja3Sxq1LqkjqTy8v7xQDGtmQCqc5F0102sSuAZXUgmd+kGVLKU0VfAec5oCfjY0P7Qg0e/AUA2dXVdXDS/nFbpVSRiF4HsARA4KX3E9ENMeSM1A2ciNZaEMwf0HlSysts+sXeTkSPcdlN84M9JHyUBQBYbSBpbtqEFudUogXVYJv+ALgUwHzT6jVNZahlAGCKYVCcuRvYs72U8iQOw0xTDoCJnMBK+vwoS9hhI1EgoruFbwAwMCYdqi11sdClKhO4hYheJKILbZ7LsgLOGnJCK8V8/yNX4YVvADDXttTF/87LYxvZQjRVjQWwyEbBZCB7vPANQRCcb1vqarKCSUf0e8JHwJAONZW6mqxg0lqxWDxH+AYAE21KXQmmh8W1Tg8JbJbwDZ0pSl3VKBaLRwO4j4h+bjC51bYpn88fKXwDYkpdcTItpdS5DnPWXcI3hClKXQwAH7og2WsBOwylrjiZFoDNDolmGyPaqdQFYJThms9dEk1EbwsfAeBLw6AWGNpPcuzRfgrYAYQGz9nB83jP9vzlb1SsbGFPib5Q6gIwyzHRK0UfKXWd2YQFSpytED4iCILhMcRN1F3D+QeHRE8VbVjqWmpoP94BwZuJ6IE4QX3LQyk1zjRAXf6ZBxvt7W44wUT0HefLOzo6jhG+o5yi1MXVjwYT/BFvu/Pag21KXabaXS8Vm7TWXgomHfjVjNnyNqWRAva2VjDZlLp4Pta9wrUI2CNRzxt8poethqNUKh1PRIqPq3C+/yUNEENczK4uWwE7azimp1EwcSmOC8TRdpLK/Xj6ula0e6kLCQXsFQUTgENs+sNvkpTyRgDvx9x/lWinUlegSehwdZyr6AZyOec9H8Dltv3o7Ow8HMCdUXjX6w/pzb7yWkpdLAXjnVVV7fj6aUqpE4UlAJzGiSNLHchq4SMQU+piSYHuGo4YODHP3mujYKpAKXUlgNdS7OLd5u2JNmFMqcuU1UsD/kGklLelKShEoSjvThsmfAbMpa7NUsrzarl3sVg8DkAZwO8pQkM+9OUenV7QS0gpR5iyeqyJSxOecRWdY/W480ViPPhTKeXNtZ6o05IAMC9m4GullNcnyaNESaslKbx3JxG9zDJf0c5QSg3p7Ry76KylCdXZNSY3CIKzWWjDMW4Kgtfxoibp5tW2AIAxFpHAxugMpu1pcx68rPYuJq4VAK7iPdqN1nMQ0bus4/NSIFMLwjAc2gRVEgvb53ipFK0HZPeJNOsb6L2s3bvfy/0pdfbkdQ0ieZlS6ta2DM9sQfU7rXFntBjhrRVllii4HlvLQEo5ug4EX5Amz9GnQERzYj5aXVzViE4/mBRTK3zG9ThaHgC+SSoABzDZ0PYzN733CDCIF9mTe7aNvFvn0evc9N4jwLBLVkd0oVA4weDRG9z03iOQ+T8/mKRpe1dbCRCbCeo+BVL7MYw+gIMim2xKcxLRs67H4ftWiz0JzboI2ydBZlVpElvouv/eQHUfn7zGlmQuAvh8bp0TALi4WjqQwNZwIsp1v72E7D6CJ8k0sqhPVUEaBSK6ItoctIKPtYxsOUcX2YcvQ4YMGTJkyJBBGPAfCdtOAS6RFE4AAAAASUVORK5CYII="/>
</defs>
</svg>

        </div>
    </a>

     {{-- Penyimpanan --}}
    <a href="{{ route('penyimpanan_barang.index') }}"
       class="w-full flex items-center justify-center py-3 relative 
       {{ request()->routeIs('penyimpanan_barang.*') ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-100' }}">
        <div class="w-6 h-6">
            <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="50" height="50" fill="url(#pattern0_284_987)"/>
<defs>
<pattern id="pattern0_284_987" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_284_987" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_284_987" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACWklEQVR4nO2cvYoTURiGj4iKhe2iKLZupcVWNlbewtxAMt8zQ9goqba1c29hb8Hazl4RhBU778BGWFldQdAjR1JmJTOTnJ/M+8ALgRQ588zH+yVFxjkhhBBCCCGEEEIIERXgDnBkZu+BHyHL10fhPd2OAVRVddXMngKvgF+AXxUz+w28ASrgmqSvSdu2D8zsGPhymdz/5KuZnTRN82jdzxsVi8Xi5nIiw2T+6SF4VT4ATCaTW27s1HV9ECbQzM43JHdVfob6CTXknLvixsJsNrttZs+BT1uUe1k+m9kL4L4b82IjUnZugQ5cbD5S/i3Q6XT60JXElhabj5T8F2ikxeYjJa8Fmnix+Z1eoLktNnZtgRay2HyxCxTYB15ncHE+0wQ3+0MlPwa+Z3AxPueY2QXwpJfktm33gLPUF0E5OQvOOote9nHqw/vC8rKz6B3/yua3ETP72GeiL3I4PAUlOOsz0ckPToGRaCTap55CTTTpxak6SC9VHY1E+9QTp4kmvSRVB+kFqqPJK/rBgkT71FOoiSa9OFUH6aVm1dGuEJDoOEh0JCQ6EhIdCYmORPGixxYn0Ug0GUyiJpr08lQdpBerjmZkol0hINFxkOhISHQkJDoSEh2J4kWPLU6ikWgymERNNOnlqTpIL1YdTSGiN/XcDVcIbOBazexb5w9ePilRounk4F2fO/xMouk60YedRc/n8xvhL7eqDtYVfVpV1XXXh7qu7w2V7QqBYTV52jTN3UEHCJMNzEP/9FmQrhDoXhPnZvY21EXvSRZCCCGEEEIIIYQQQgg3Gv4C1WfzSwpEMAEAAAAASUVORK5CYII="/>
</defs>
</svg>

        </div>
    </a>

    {{-- Permintaan --}}
    <a href="{{ route('permintaan_barang.index') }}"
       class="w-full flex items-center justify-center py-3 relative 
       {{ request()->routeIs('permintaan_barang.*') ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-100' }}">
        <div class="w-6 h-6">
            <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="50" height="50" fill="url(#pattern0_288_379)"/>
<defs>
<pattern id="pattern0_288_379" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_288_379" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_288_379" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACUElEQVR4nO3dsW4UQRAE0InAn4CB7yAiICIivfik1XaNdOIg4/yDBhEZf4plLHujQSNdYB0IA8u5unurpI7Pflfq9c5K3lIURVEURVHCZL1en5jZRzP7CuA7gEacCcB5rfVVyZRxHF8CuCTjtl/MLYC3JUuTnSK3VNh9XTjAbOmx9zuZDdnSY5vZtQPEdm9uUmI7gG0H8/p3X76Z3Y3j+K5EiwPYdn/2P1M+bI/QKbG9QqfD9gydCts7dBrsCNApsKNAh8eOBB0aOxp0WOyI0CGxo0KHw44MHQo7OnQY7AzQPbXWNw8dsVKfQbJhcTDDMDw/IvZ5YYUNi59nN+f3eQB7Kqw4gG2HGB37WM0urDiAbY85goag6S2EGg06nFYH+Kja0RA0vXFQo0FH0uoAH1A7Gr5GNywQNL2FUKNBh9PqAB9VOxqC/pNWTGb2ac558dz0z+5n1vuz67SN3hUn2WOnhT4tTrLZbJ6lhR6IK+MwtdYXaaHha3WcZYae5j48nZulXAxb5BE0BE1vIdRo0OG0OsBH1Y6GoF2ddQwz/ozL0OhdhDONDNCnEc40wkMPhDvCfznTCA8Nzuo4WyL09FhnHUu/GLbII2gImt5CqNGgw2l1gI+qHQ1B0xsHNRp0JK0O8AG1o+FrdMMCQdNbCDUadDitDvBRtaOxQGiH/3q+HWvM7IoJHeVlCu0/zBcaNIAPC2r0exr0drt9ambf2Ag4/lysVqsnhf0Kp+TYF/1JevGQ3mwA277HMlwgzezazD73dUFvsqIoiqIoSvmb/ABXi5ir7M+OBAAAAABJRU5ErkJggg=="/>
</defs>
</svg>

        </div>
    </a>

    {{-- Pengemasan --}}
    <a href="{{ route('pengemasan_barang.index') }}"
       class="w-full flex items-center justify-center py-3 relative 
       {{ request()->routeIs('pengemasan_barang.*') ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-100' }}">
        <div class="w-6 h-6">
            <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="50" height="50" fill="url(#pattern0_288_538)"/>
<defs>
<pattern id="pattern0_288_538" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_288_538" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_288_538" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
</defs>
</svg>

        </div>
    </a>

    {{-- Pengiriman --}}
    <a href="{{ route('pengiriman_barang.index') }}"
       class="w-full flex items-center justify-center py-3 relative 
       {{ request()->routeIs('pengiriman_barang.*') ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-100' }}">
        <div class="w-6 h-6">
            <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="50" height="50" fill="url(#pattern0_288_537)"/>
<defs>
<pattern id="pattern0_288_537" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_288_537" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_288_537" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACz0lEQVR4nO2cy4oTURRF70RbnYv4BHWmQx9DQcRPyEwISe7eZQ1KyUClG3viJ/jAngsOxB+wP8DHTNFvEERRwUTw0ZRcqYFIxyJJVZ1b5V5wCDSk2bVyslMJqTgnhBBCCCGEEEIIIYQQ4m/6/f4uAFcBvCA5IZlHPBOSz0leybJspTWPpvf+EMlXEQjM5x0AL0N+14ZNbqtk/iE7+s0OdWEtitVM5mKm6OS8A/PMxQyALxFIypedcBwuZqwFscJxMWMthxJtL47aaHupVHVI9LZYbyG10fbiaDwAPobzc5KXwztotwzWB8OWDIDXaZoelmg2IvxNr9fbqY1mI7KvSTQbqZB3C31SaN19bOdckmguLO8bgOvD4fDAUmcX2miWib7h6iSCp2EeyeyXaNYvulbJ2mhKNBuuDm00Jdr6xSvXRkcgjqoOmktVR1OizTeO2mh7SVR10FygOppxjd6wsCMPmHUwdmwkmhKdW2+hNpr24lQdtJeqjqZE59Ybp42mvSRVB+0FqqMZ1+gNCyU6t95CbTTtxak62IKOJrmH5D2Sn6u4NBjAqvf+KMkdxe1aC37zo678nwDcHY/Hu4PojapCeu9Pzfj49XTssmvOvxEutP9aUdDVku/13bSWaZh/Wpno8DQrCXrcWqZh/mll1VF2hVKWZSvWMq3yA7jvQlGTvBOKO+KNyOueOvKHi0AB3P79YjgvADZn/OO1kqDrM+73xDVIa/L/40VhAuDMdvdJkuRs6KlFDvC/zV+cW/6cFTYcSJqmx0LnFU+39VkhAfwgeaSWoF3ID+BhFb0I4EFtIbuQfzAY7A1XjS4Z9P1oNNpXa9Au5Cd5folz8CnJc7WH7Er+JEkuAvgw7yaQvOAioFX5i98yfQxgq6TPtkg+SpLkoIuI1uX33p8keav4lZa3JL+HWwBPw9+TJDnhIqbt+YUQQgghhBBCCCFcg/wCt2mUtnZNctAAAAAASUVORK5CYII="/>
</defs>
</svg>

        </div>
    </a>
    
    </nav>

    
</aside>

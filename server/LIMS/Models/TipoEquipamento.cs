using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class TipoEquipamento
    {
        public int Id { get; set; }
        [Required]
        public string Tipo { get; set; }
        public DateTime Delete_at { get; set; }
    }
}

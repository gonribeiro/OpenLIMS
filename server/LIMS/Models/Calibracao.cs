using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Calibracao
    {
        public int Id { get; set; }
        [Required]
        public int EquipamentoId { get; set; }
        public Equipamento Equipamento { get; set; }
        [Required]
        public DateTime Calibrado { get; set; }
        [Required]
        public DateTime Validade { get; set; }
        public DateTime Delete_at { get; set; }
    }
}
